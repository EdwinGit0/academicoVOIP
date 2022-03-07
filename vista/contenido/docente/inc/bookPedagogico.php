<script>
    /**--------------------------------- DATOS REFERENCIALES --------------------------------- */
    function datosReferenciales() {
        fila.find('input[type=hidden]').each(function() {
            id_curso = this.value;
        });
        id_curso = id_curso.trim();
    
        if(id_curso!=""){
            let datos = new FormData();
            datos.append("curso_id_referencial", id_curso);

            fetch("<?php echo SERVERURL?>ajax/docente/cuadernoPAjax.php",{
                method: 'POST',
                body: datos
            })
            .then(respuesta => respuesta.text())
            .then(respuesta => {
                let tabla_padre=document.querySelector('#body_referencial');
                tabla_padre.innerHTML=respuesta;

                datosAfiliacion();

                <?php foreach($campos_periodo as $rows){ ?>
                    tablaPeriodo('<?php echo $rows['COD_PER']; ?>');
                <?php } ?>
                tablaResumen();
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

    /**--------------------------------- DATOS AFILIACION --------------------------------- */
    function datosAfiliacion() {
        let docente_id=document.querySelector('#docente_id_curso').value;
        let url=document.querySelector('#docente_url_curso').value;
        docente_id=docente_id.trim();
        url=url.trim();

        fila.find('input[type=hidden]').each(function() {
            id_curso = this.value;
        });
        id_curso = id_curso.trim();
    
        if(id_curso!=""){
            let datos = new FormData();
            datos.append("curso_id_afiliacion", id_curso);
            datos.append("docente_id", docente_id);
            datos.append("cuaderno_pedagogico", "cuadernoPedagogico");
            datos.append("url", url);

            fetch("<?php echo SERVERURL?>ajax/docente/cuadernoPAjax.php",{
                method: 'POST',
                body: datos
            })
            .then(respuesta => respuesta.text())
            .then(respuesta => {
                let tabla_padre=document.querySelector('#body_afiliacion');
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

    /**--------------------------------- TABLA CUADERBNO PEDAGOGICO --------------------------------- */
    function tablaPeriodo(id) {
        let docente_id=document.querySelector('#docente_id_curso').value;
        let url=document.querySelector('#docente_url_curso').value;
        docente_id=docente_id.trim();
        url=url.trim();

        fila.find('input[type=hidden]').each(function() {
            id_curso = this.value;
        });
        id_curso = id_curso.trim();
    
        if(id_curso!=""){
            let datos = new FormData();
            datos.append("curso_id_periodo", id_curso);
            datos.append("docente_id", docente_id);
            datos.append("periodo_id", id);
            datos.append("url", url);
            fetch("<?php echo SERVERURL?>ajax/docente/cuadernoPAjax.php",{
                method: 'POST',
                body: datos
            })
            .then(respuesta => respuesta.text())
            .then(respuesta => {
                let tabla_padre=document.querySelector('#body-tabla'+id);
                tabla_padre.innerHTML=respuesta;
                
                if(document.querySelector('#aprob_trim'+id) && document.querySelector('#reprob_trim'+id)){
                    let num_aprobados=document.querySelector('#aprob_trim'+id).value;
                    let num_reprobados=document.querySelector('#reprob_trim'+id).value;
                    pastel('myChart'+id,num_aprobados,num_reprobados);
                }

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

    /**--------------------------------- PROMEDIO CALIFICACIONES --------------------------------- */
    function promedio_val(columns,tipo,val_promedio) {
        var suma=0,total=0,pos_promedio=0;
        columns.each(function() {
            if(this.className==tipo){
                suma = suma+Number(this.textContent);
                total++;
            }
        });
        promedio = (suma/total)*0.35;

        columns.each(function() {
            if(this.id==val_promedio){
                return false;
            }
            pos_promedio++;
        });
        columns.eq(pos_promedio).text(promedio.toFixed(2));

        promedio_total(columns,'campo_total');
    }   

    /**--------------------------------- PROMEDIO CALIFICACIONES S-D --------------------------------- */
    function promedio_valSD(columns,tipo,val_promedio) {
        var suma=0,pos_promedio=0;
        columns.each(function() {
            if(this.className==tipo){
                suma = suma+Number(this.textContent);
            }
        });

        columns.each(function() {
            if(this.id==val_promedio){
                return false;
            }
            pos_promedio++;
        });
        columns.eq(pos_promedio).text(suma.toFixed(2));
        promedio_total(columns,'campo_total');
    }   

    /**--------------------------------- PROMEDIO TOTAL --------------------------------- */
    function promedio_total(columns,val_promedio) {
        var suma=0,pos_promedio=0;
        columns.each(function() {
            if(this.id=="prom_par" || this.id=="prom_act" || this.id=="prom_SD" ){
                suma = suma+Number(this.textContent);
            }
        });

        columns.each(function() {
            if(this.className==val_promedio){
                return false;
            }
            pos_promedio++;
        });
        columns.eq(pos_promedio).text(suma.toFixed());

        if(suma.toFixed()<51){
            columns.eq(pos_promedio+1).text('REPROBADO');

            columns.each(function() {
            if(this.className=="prom_estado" || this.className=="campo_total"){
                    this.style.color = "red";
                }
            });
        }else{
            columns.eq(pos_promedio+1).text('APROBADO');
            columns.each(function() {
            if(this.className=="prom_estado" || this.className=="campo_total"){
                    this.style.color = "black";
                }
            });
        }
    } 

    /**--------------------------------- GUARDAR Y ACTUALIZAR CUADERNO P --------------------------------- */
    function guardar_cuadernoP(table){
        Swal.fire({
        title: "¿Estas seguro?",
        text: 'Los datos quedaran guardados en el sistema',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText:'Si, agregar',
        cancelButtonText:'No, cancelar'
        }).then((result) => {
            if (result.value){
                let id_curso=document.querySelector('#id_curso_table').value;
                table.find('input#id_periodo_table').each(function() {
                    id_periodo = this.value;
                });

                table.find('input#cuaderno_reg').each(function() {
                    cuaderno_reg = this.value;
                });
                cuaderno_reg=cuaderno_reg.trim();
                id_curso = id_curso.trim();
                id_periodo=id_periodo.trim();

                var filas = [];
                table.find('tbody tr').each(function() {
                    var id_alumno = $(this).find('input').val();
                    var parciales=[];
                    $(this).find('td').each(function() {
                        let parcial = this.id;
                        let nota = this.textContent;
                        if(this.className=="campo_par" || this.className=="campo_act" || this.className=="campo_sd" || this.className=="campo_total"){
                            var fila_par = {
                                parcial,
                                nota
                            };
                            parciales.push(fila_par);
                        }
                    });

                    var fila = {
                        id_alumno,
                        parciales
                    };
                    filas.push(fila);
                });

                let datos = new FormData();
                datos.append("id_cuaderno_reg", cuaderno_reg);
                datos.append("id_agregar_curso", id_curso);
                datos.append("id_agregar_periodo", id_periodo);
                datos.append("tabla", JSON.stringify(filas));

                fetch("<?php echo SERVERURL?>ajax/docente/cuadernoPAjax.php",{
                    method: 'POST',
                    body: datos
                })
                .then(respuesta => respuesta.json())
                .then(respuesta => {
                    datosReferenciales();
                    return alertas_ajax(respuesta);
                });
            }
        });
    }

    /**--------------------------------- PASTEL APROBADOS / REPROBADOS --------------------------------- */
    function pastel(id_periodo,num_aprobados,num_reprobados){
        var etiquetas  = ["Aprobado", "Reprobado"];
        var datos = [num_aprobados, num_reprobados];
        var barColors = [
                            "#00aba9",
                            "#b91d47"
                        ];
        new Chart(id_periodo, {
            type: "doughnut",
            data: {
                labels: etiquetas ,
                datasets: [{
                            backgroundColor: barColors,
                            data: datos
                        }]
                },
        });
    }

    /**--------------------------------- TABLA RESUMEN CUADERNO PEDAGOGICO --------------------------------- */
    function tablaResumen() {
        let docente_id=document.querySelector('#docente_id_curso').value;
        let url=document.querySelector('#docente_url_curso').value;
        docente_id=docente_id.trim();
        url=url.trim();

        fila.find('input[type=hidden]').each(function() {
            id_curso = this.value;
        });
        id_curso = id_curso.trim();
    
        if(id_curso!=""){
            let datos = new FormData();
            datos.append("curso_id_resumen", id_curso);
            datos.append("docente_id", docente_id);
            datos.append("url", url);
            fetch("<?php echo SERVERURL?>ajax/docente/cuadernoPAjax.php",{
                method: 'POST',
                body: datos
            })
            .then(respuesta => respuesta.text())
            .then(respuesta => {
                let tabla_padre=document.querySelector('#body_resumen');
                tabla_padre.innerHTML=respuesta;

                pastelAnual();
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

    /**--------------------------------- PASTEL APROBADOS / REPROBADOS ANUAL --------------------------------- */
    function pastelAnual(){
        var ctx = document.getElementById('grafico-anual'); // node
        var ctx = document.getElementById('grafico-anual').getContext('2d'); // 2d context
        var ctx = $('#grafico-anual'); // jQuery instance
        var ctx = 'grafico-anual'; // element id
        
        let num_aprobados=document.querySelector('#aprob_anual').value;
        let num_reprobados=document.querySelector('#reprob_anual').value;

        var etiquetas  = ["Aprobado", "Reprobado"];
        var datos = [num_aprobados, num_reprobados];
        var barColors = [
                            "#00aba9",
                            "#b91d47"
                        ];
        new Chart(ctx, {
            type: "pie",
            data: {
                labels: etiquetas ,
                datasets: [{
                            backgroundColor: barColors,
                            data: datos
                        }]
                },
            options: {
                title: {
                display: true,
                text: "Alumnos aprobados y reprobados"
                }
            }
        });
    }

</script>