const formulario_ajax = document.querySelectorAll(".FormularioAjax");

function enviar_formulario_ajax(e){
    e.preventDefault();

    let data = new FormData(this);
    let method = this.getAttribute("method");
    let action = this.getAttribute("action");
    let tipo = this.getAttribute("data-form");

    let encabezado = new Headers();

    let config = {
        method: method,
        Headers: encabezado,
        mode: 'cors',
        cache: 'no-cache',
        body: data
    }

    let texto_alerta;

    if(tipo==="save"){
        texto_alerta="Los datos quedaran guardados en el sistema";
    }else if(tipo==="delete"){
        texto_alerta="Los datos seran eliminados completamente del sistema";
    }else if(tipo==="update"){
        texto_alerta="Los datos del sistema seran actualizados";
    }else if(tipo==="search"){
        texto_alerta="Se eliminara el termino de busqueda y tendra que escribir uno nuevo";
    }else if(tipo==="load"){
        texto_alerta="¿Desea remover los datos seleccionados?";
    }else{
        texto_alerta="Quieres realizar la operacion sololicitada";
    }
    swal({
        title: "¿Estas seguro?",
        text: texto_alerta,
        icon: "warning",
        buttons: ["Cancelar", "Aceptar"],
        closeOnClickOutside: false,
      })
      .then((willDelete) => {
        if (willDelete) {
            fetch(action,config)
            .then(respuesta => respuesta.json())
            .then(respuesta => {
                return alertas_ajax(respuesta);
            });
        } 
    });
}

formulario_ajax.forEach(formularios => {
    formularios.addEventListener("submit", enviar_formulario_ajax);
});

function alertas_ajax(alerta){
    if(alerta.Alerta==="simple"){
        if(alerta.Tipo==="validation"){
            getIDInput(alerta.Input).focus();
        }else{
            swal({
                title: alerta.Titulo,
                text: alerta.Texto,
                icon: alerta.Tipo,
                button: "Aceptar",
            });
        }
    }else if(alerta.Alerta==="recargar"){
        swal({
            title: alerta.Titulo,
            text: alerta.Texto,
            icon: alerta.Tipo,
            button: "Aceptar",
            closeOnClickOutside: false,
          })
          .then((willDelete) => {
            if (willDelete) {
                location.reload();
            } 
        });
    }else if(alerta.Alerta==="limpiar"){
        swal({
            title: alerta.Titulo,
            text: alerta.Texto,
            icon: alerta.Tipo,
            button: "Aceptar",
            closeOnClickOutside: false,
          })
          .then((willDelete) => {
            if (willDelete) {
                document.querySelector(".FormularioAjax").reset();
            } 
        });
    }else if(alerta.Alerta==="redireccionar"){
        window.location.href=alerta.URL;
    }
}