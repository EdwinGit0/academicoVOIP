<div class="login-container">
    <div class="position">
        <div class="login-content">
            <p class="text-center">
                <i class="fas fa-user-circle fa-5x"></i>
            </p>
            <p >
                <h4 class="text-center fw-bold mb-2"><strong>Inicia sesión con tu cuenta</strong></h4>
            </p>

            <form action="" method="POST" autocomplete="off" >
                <div class="form-group">
                    <label for="UserName" class="bmd-label-floating"><i class="fas fa-user-secret"></i> &nbsp; Correo</label>
                    <input type="email" class="form-control" id="usuario_email" name="usuario_correo_lo" maxlength="50"  >
                </div>
                <div class="form-group">
                    <label for="UserPassword" class="bmd-label-floating"><i class="fas fa-key"></i> &nbsp; Contraseña</label>
                    <input type="password" class="form-control" id="UserPassword" name="usuario_clave_lo" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100"  >
                </div>
                <button type="submit" class="btn-login text-center btn-lg">Iniciar sesión</button>
            </form>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['usuario_correo_lo']) && isset($_POST['usuario_clave_lo'])){
        require_once "./controlador/admin/controlador_login.php";

        $ins_login= new controlador_login();

        echo $ins_login->iniciar_sesion_controlador();
    }

?>