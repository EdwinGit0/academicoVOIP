<script type='text/javascript'>
    let token = JSON.parse(localStorage.getItem("token"));
    if(token){
        let url='<?php echo SERVERURL; ?>ajax/admin/loginAjax.php';
        let datos = new FormData();
        datos.append("token_login",token);

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
                }).then((willDelete) => {
                    if (willDelete) {
                        localStorage.removeItem("token");
                        location.reload();
                    } 
                });
                
            }
        });
    }
</script>
<div class="login-container">
    <div class="position">
        <div class="login-content">
            <p class="text-center">
                <i class="fas fa-user-circle fa-5x"></i>
            </p>
            <p >
                <h4 class="text-center fw-bold mb-2"><strong>Inicia sesión con tu cuenta</strong></h4>
            </p>

            <form action="" method="POST" autocomplete="off" novalidate >
                <div class="form-group">
                    <label for="UserName" class="bmd-label-floating"><i class="fas fa-user-secret"></i> &nbsp; Correo</label>
                    <input type="email" class="form-control" id="usuario_email" name="usuario_correo_lo" maxlength="50" required onchange="deleteErrorMessage('usuario_email_error')">
                    <div class='message-error' id="usuario_email_error"></div>
                </div>
         
                <div class="form-group">
                    <label for="UserPassword" class="bmd-label-floating"><i class="fas fa-key"></i> &nbsp; Contraseña</label>
                    <input type="password" class="form-control" id="UserPassword" name="usuario_clave_lo" pattern="[a-zA-Z0-9@#$%&.-]{7,20}" maxlength="20" required onchange="deleteErrorMessage('usuario_password_error')">
                    <div class='message-error' id="usuario_password_error"></div>
                </div>
                <button type="submit" class="btn-login text-center btn-lg">Iniciar sesión</button>
            </form>
        </div>
    </div>
</div>
<?php include_once "./vista/contenido/login/inc/login.php"?>