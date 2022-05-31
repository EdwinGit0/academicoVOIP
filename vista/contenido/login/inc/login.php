<script>
    let btn_iniciar=document.querySelector(".btn-login");
    btn_iniciar.addEventListener('click', function(e){
        e.preventDefault();

        if(login_validata()){
            let url='<?php echo SERVERURL; ?>ajax/admin/loginAjax.php';
            let email=document.querySelector('#usuario_email').value;
            let passw=document.querySelector('#UserPassword').value;
            email=email.trim();
            passw=passw.trim();

            let datos = new FormData();
            datos.append("usuario_correo_lo",email);
            datos.append("usuario_clave_lo",passw);

            fetch(url,{
                method: 'POST',
                body: datos
            })
            .then(respuesta => respuesta.json())
            .then(respuesta => {
                if(respuesta.Alerta==="redireccionar"){
                    localStorage.setItem("token", JSON.stringify(respuesta.token));
                    window.location.href=respuesta.URL;
                }else if(respuesta.Alerta==="simple"){
                    swal({
                        title: respuesta.Titulo,
                        text: respuesta.Texto,
                        icon: respuesta.Tipo,
                        button: "Aceptar",
                    });
                }
            });
        }
    });
</script>