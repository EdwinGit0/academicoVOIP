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

            fetch("<?php echo SERVERURL?>ajax/docente/registroPAjax.php",{
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
            swal({
                title: 'Ocurrio un error',
                text: 'El curso que selecciono no existe',
                icon: 'error',
                button: "Aceptar",
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
            datos.append("cuaderno_pedagogico", "registroPedagogico");
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
            swal({
                title: 'Ocurrio un error',
                text: 'El curso que selecciono no existe',
                icon: 'error',
                button: "Aceptar",
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
            fetch("<?php echo SERVERURL?>ajax/docente/registroPAjax.php",{
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
            swal({
                title: 'Ocurrio un error',
                text: 'El curso que selecciono no existe',
                icon: 'error',
                button: "Aceptar",
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
            fetch("<?php echo SERVERURL?>ajax/docente/registroPAjax.php",{
                method: 'POST',
                body: datos
            })
            .then(respuesta => respuesta.text())
            .then(respuesta => {
                let tabla_padre=document.querySelector('#body_centralizador');
                tabla_padre.innerHTML=respuesta;

                pastelAnual();
            });
        }else{
            swal({
                title: 'Ocurrio un error',
                text: 'El curso que selecciono no existe',
                icon: 'error',
                button: "Aceptar",
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