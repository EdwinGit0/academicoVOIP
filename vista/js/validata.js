/* VALIDATION INPUTS LOGIN FORM */
function login_validata() {
    let mail = getIDInput('usuario_email');
    let password = getIDInput('UserPassword');
    let message_email = ''
    let message_password = ''
    let enviar = true;

    if(mail.value === null || mail.value === ''){
        message_email = 'Este campo es requerido'
        mail.focus();
        enviar = false;
    }else if(!validateEmail(mail.value)){
            message_email = 'Ha ingresado un CORREO no valido'
            mail.focus();
            enviar = false;
    }
    
    if(password.value === null || password.value === ''){
        message_password = 'Este campo es requerido'
        password.focus();
        enviar = false;
    }else if (!password.value.match(/^[a-zA-Z0-9@#$%&.-]/)) {
            message_password = 'La Contraseña no coincide con el formato solicitado'
            password.focus();
            enviar = false; 
    }else if (password.value.length < 7 || password.value.length > 20) {
            message_password = 'La CONTRASEÑA debe ser mayor a 7 caracteres'
            password.focus();
            enviar = false; 
    }

    if(mail.value === '' && password.value === ''){
        mail.focus();
    }

    getIDInput("usuario_email_error").innerHTML = message_email;  
    getIDInput("usuario_password_error").innerHTML = message_password;
    
    return enviar
}

/* VALIDATION INPUT SEARCH */

function search_validata(input) {
    let search = getIDInput(input);
    let message_search = ''
    let enviar = true;

    if(search.value === null || search.value === ''){
        message_search = 'Por favor introduce un termino de busqueda para empezar'
        enviar = false;
    }
    
    getIDInput(input+'_error').innerHTML = message_search;
    
    return enviar
}

/* VALIDATION INPUTS STUDENT FORM */

function student_new_validata() {
    let ci = getIDInput('alumno_ci');
    let nombre = getIDInput('alumno_nombre');
    let apellidoP = getIDInput('alumno_apellidoP');
    let apellidoM = getIDInput('alumno_apellidoM');
    let fechaNac = getIDInput('alumno_fechaNac');
    let sexo = getIDInput('alumno_sexo');
    let lugarNac = getIDInput('alumno_lugarNac');
    let email = getIDInput('alumno_email');
    let direccion = getIDInput('alumno_direccion');
    let telefono = getIDInput('alumno_telefono');
    let clave1 = getIDInput('alumno_clave_1');
    let clave2 = getIDInput('alumno_clave_2');

    let message_ci = ''
    let message_nombre = ''
    let message_apellidoP = ''
    let message_apellidoM = ''
    let message_fechaNac = ''
    let message_sexo = ''
    let message_lugarNac = ''
    let message_email = ''
    let message_direccion = ''
    let message_telefono = ''
    let message_clave1 = ''
    let message_clave2 = ''

    let enviar = true;

    if(ci.value === null || ci.value === ''){
        message_ci = 'Este campo es requerido'
        enviar = false;
    }else if(!ci.value.match(/^[0-9-]/)){
        message_ci = 'El CI no coincide con el formato solicitado'
        enviar = false;
    }else if (ci.value.length < 5 || ci.value.length > 15) {
        message_ci = 'El CI debe ser mayor a 5 digitos'
        enviar = false; 
    }

    if(nombre.value === null || nombre.value === ''){
        message_nombre = 'Este campo es requerido'
        enviar = false;
    }else if(!nombre.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_nombre = 'El NOMBRE no coincide con el formato solicitado'
        enviar = false;
    }else if (nombre.value.length < 3 || nombre.value.length > 30) {
        message_nombre = 'El NOMBRE debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(apellidoP.value === null || apellidoP.value === ''){
        message_apellidoP = 'Este campo es requerido'
        enviar = false;
    }else if(!apellidoP.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_apellidoP = 'El APELLIDO PATERNO no coincide con el formato solicitado'
        enviar = false;
    }else if (apellidoP.value.length < 3 || apellidoP.value.length > 50) {
        message_apellidoP = 'El APELLIDO PATERNO debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(apellidoM.value === null || apellidoM.value === ''){
        message_apellidoM = 'Este campo es requerido'
        enviar = false;
    }else if(!apellidoM.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_apellidoM = 'El APELLIDO MATERNO no coincide con el formato solicitado'
        enviar = false;
    }else if (apellidoM.value.length < 3 || apellidoM.value.length > 50) {
        message_apellidoM = 'El APELLIDO MATERNO debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(fechaNac.value === null || fechaNac.value === ''){
        message_fechaNac = 'Este campo es requerido'
        enviar = false;
    }

    if(sexo.value === null || sexo.value === ''){
        message_sexo = 'Este campo es requerido'
        enviar = false;
    }

    if(lugarNac.value === null || lugarNac.value === ''){
        message_lugarNac = 'Este campo es requerido'
        enviar = false;
    }else if(!lugarNac.value.match(/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]/)){
        message_lugarNac = 'El LUGAR de NACIMIENTO no coincide con el formato solicitado'
        enviar = false;
    }else if (lugarNac.value.length < 3 || lugarNac.value.length > 150) {
        message_lugarNac = 'El LUGAR de NACIMIENTO debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(email.value !== '' && !validateEmail(email.value)){
        message_email = 'Ha ingresado un CORREO no valido'
        enviar = false;
    }

    if(direccion.value !== '' && !direccion.value.match(/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]/)){
        message_direccion = 'La DIRECCION no coincide con el formato solicitado'
        enviar = false;
    }else if (direccion.value !== '' &&  direccion.value.length < 3 || direccion.value.length > 150) {
        message_direccion = 'La DIRECCION debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(telefono.value === null || telefono.value === ''){
        message_telefono = 'Este campo es requerido'
        enviar = false;
    }else if(!telefono.value.match(/^[0-9()+]/)){
        message_telefono = 'El TELEFONO no coincide con el formato solicitado'
        enviar = false;
    }else if (telefono.value.length < 7 || telefono.value.length > 15) {
        message_telefono = 'El TELEFONO debe ser mayor a 7 digitos'
        enviar = false; 
    }

    if(clave1.value === null || clave1.value === ''){
        message_clave1 = 'Este campo es requerido'
        enviar = false;
    }else if(!clave1.value.match(/^[a-zA-Z0-9@#$%&.-]/)){
        message_clave1 = 'La CONTRASEÑA no coincide con el formato solicitado'
        enviar = false;
    }else if (clave1.value.length < 7 || clave1.value.length > 20) {
        message_clave1 = 'La CONTRASEÑA debe ser mayor a 7 digitos'
        enviar = false; 
    }

    if(clave2.value === null || clave2.value === ''){
        message_clave2 = 'Este campo es requerido'
        enviar = false;
    }else if(!clave2.value.match(/^[a-zA-Z0-9@#$%&.-]/)){
        message_clave2 = 'El CONTRASEÑA no coincide con el formato solicitado'
        enviar = false;
    }else if (clave2.value.length < 7 || clave2.value.length > 20) {
        message_clave2 = 'El CONTRASEÑA debe ser mayor a 7 digitos'
        enviar = false; 
    }

    if(clave1.value !== clave2.value){
        message_clave2 = 'La CONTRASEÑA que acaba de ingresar no coinciden'
    }

    getIDInput("alumno_ci_error").innerHTML = message_ci;  
    getIDInput("alumno_nombre_error").innerHTML = message_nombre;
    getIDInput("alumno_apellidoP_error").innerHTML = message_apellidoP;  
    getIDInput("alumno_apellidoM_error").innerHTML = message_apellidoM;
    getIDInput("alumno_fechaNac_error").innerHTML = message_fechaNac;  
    getIDInput("alumno_sexo_error").innerHTML = message_sexo;
    getIDInput("alumno_lugarNac_error").innerHTML = message_lugarNac;  
    getIDInput("alumno_email_error").innerHTML = message_email;  
    getIDInput("alumno_direccion_error").innerHTML = message_direccion;
    getIDInput("alumno_telefono_error").innerHTML = message_telefono;
    getIDInput("alumno_clave_1_error").innerHTML = message_clave1;  
    getIDInput("alumno_clave_2_error").innerHTML = message_clave2;

    return enviar;
}

function student_update_validata() {
    let ci = getIDInput('alumno_ci');
    let nombre = getIDInput('alumno_nombre');
    let apellidoP = getIDInput('alumno_apellidoP');
    let apellidoM = getIDInput('alumno_apellidoM');
    let fechaNac = getIDInput('alumno_fecha_nac');
    let sexo = getIDInput('alumno_sexo');
    let lugarNac = getIDInput('alumno_lugarNac');
    let email = getIDInput('alumno_email');
    let direccion = getIDInput('alumno_direccion');
    let telefono = getIDInput('alumno_telefono');
    let clave1 = getIDInput('alumno_clave_nueva_1');
    let clave2 = getIDInput('alumno_clave_nueva_2');
    let educativo = getIDInput('alumno_id_educativo');

    let message_ci = ''
    let message_nombre = ''
    let message_apellidoP = ''
    let message_apellidoM = ''
    let message_fechaNac = ''
    let message_sexo = ''
    let message_lugarNac = ''
    let message_email = ''
    let message_direccion = ''
    let message_telefono = ''
    let message_clave1 = ''
    let message_clave2 = ''
    let message_educativo = ''

    let enviar = true;

    if(ci.value === null || ci.value === ''){
        message_ci = 'Este campo es requerido'
        enviar = false;
    }else if(!ci.value.match(/^[0-9-]/)){
        message_ci = 'El CI no coincide con el formato solicitado'
        enviar = false;
    }else if(ci.value.length < 5 || ci.value.length > 15) {
        message_ci = 'El CI debe ser mayor a 5 digitos'
        enviar = false; 
    }

    if(nombre.value === null || nombre.value === ''){
        message_nombre = 'Este campo es requerido'
        enviar = false;
    }else if(!nombre.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_nombre = 'El NOMBRE no coincide con el formato solicitado'
        enviar = false;
    }else if (nombre.value.length < 3 || nombre.value.length > 30) {
        message_nombre = 'El NOMBRE debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(apellidoP.value === null || apellidoP.value === ''){
        message_apellidoP = 'Este campo es requerido'
        enviar = false;
    }else if(!apellidoP.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_apellidoP = 'El APELLIDO PATERNO no coincide con el formato solicitado'
        enviar = false;
    }else if (apellidoP.value.length < 3 || apellidoP.value.length > 50) {
        message_apellidoP = 'El APELLIDO PATERNO debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(apellidoM.value === null || apellidoM.value === ''){
        message_apellidoM = 'Este campo es requerido'
        enviar = false;
    }else if(!apellidoM.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_apellidoM = 'El APELLIDO MATERNO no coincide con el formato solicitado'
        enviar = false;
    }else if (apellidoM.value.length < 3 || apellidoM.value.length > 50) {
        message_apellidoM = 'El APELLIDO MATERNO debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(fechaNac.value === null || fechaNac.value === ''){
        message_fechaNac = 'Este campo es requerido'
        enviar = false;
    }

    if(sexo.value === null || sexo.value === ''){
        message_sexo = 'Este campo es requerido'
        enviar = false;
    }

    if(lugarNac.value === null || lugarNac.value === ''){
        message_lugarNac = 'Este campo es requerido'
        enviar = false;
    }else if(!lugarNac.value.match(/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]/)){
        message_lugarNac = 'El LUGAR de NACIMIENTO no coincide con el formato solicitado'
        enviar = false;
    }else if (lugarNac.value.length < 3 || lugarNac.value.length > 150) {
        message_lugarNac = 'El LUGAR de NACIMIENTO debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(email.value !== '' && !validateEmail(email.value)){
        message_email = 'Ha ingresado un CORREO no valido'
        enviar = false;
    }

    if(direccion.value !== '' && !direccion.value.match(/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]/)){
        message_direccion = 'La DIRECCION no coincide con el formato solicitado'
        enviar = false;
    }else if (direccion.value !== '' &&  direccion.value.length < 3 || direccion.value.length > 150) {
        message_direccion = 'La DIRECCION debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(telefono.value === null || telefono.value === ''){
        message_telefono = 'Este campo es requerido'
        enviar = false;
    }else if(!telefono.value.match(/^[0-9()+]/)){
        message_telefono = 'El TELEFONO no coincide con el formato solicitado'
        enviar = false;
    }else if (telefono.value.length < 7 || telefono.value.length > 15) {
        message_telefono = 'El TELEFONO debe ser mayor a 7 digitos'
        enviar = false; 
    }

    if(clave1.value !== '' && !clave1.value.match(/^[a-zA-Z0-9@#$%&.-]/)){
        message_clave1 = 'La CONTRASEÑA no coincide con el formato solicitado'
        enviar = false;
    }else if (clave1.value !== '' && clave1.value.length < 7 || clave1.value.length > 20) {
        message_clave1 = 'La CONTRASEÑA debe ser mayor a 7 digitos'
        enviar = false; 
    }

    if(clave2.value !== '' && !clave2.value.match(/^[a-zA-Z0-9@#$%&.-]/)){
        message_clave2 = 'El CONTRASEÑA no coincide con el formato solicitado'
        enviar = false;
    }else if (clave2.value !== '' && clave2.value.length < 7 || clave2.value.length > 20) {
        message_clave2 = 'El CONTRASEÑA debe ser mayor a 7 digitos'
        enviar = false; 
    }
    
    if(clave2.value !== '' && clave2.value !== '' && clave1.value !== clave2.value){
        message_clave2 = 'La CONTRASEÑA que acaba de ingresar no coinciden'
    }

    if(educativo.value === null || educativo.value === ''){
        message_educativo = 'Este campo es requerido'
        enviar = false;
    }

    getIDInput("alumno_ci_error").innerHTML = message_ci;  
    getIDInput("alumno_nombre_error").innerHTML = message_nombre;
    getIDInput("alumno_apellidoP_error").innerHTML = message_apellidoP;  
    getIDInput("alumno_apellidoM_error").innerHTML = message_apellidoM;
    getIDInput("alumno_fechaNac_error").innerHTML = message_fechaNac;  
    getIDInput("alumno_sexo_error").innerHTML = message_sexo;
    getIDInput("alumno_lugarNac_error").innerHTML = message_lugarNac;  
    getIDInput("alumno_email_error").innerHTML = message_email;  
    getIDInput("alumno_direccion_error").innerHTML = message_direccion;
    getIDInput("alumno_telefono_error").innerHTML = message_telefono;
    getIDInput("alumno_clave_nueva_1_error").innerHTML = message_clave1;  
    getIDInput("alumno_clave_nueva_2_error").innerHTML = message_clave2;
    getIDInput("alumno_id_educativo_error").innerHTML = message_educativo;

    return enviar;
}

/* VALIDATION INPUTS PARENTS FORM */

function parent_new_validata() {
    let ci = getIDInput('padre_ci');
    let nombre = getIDInput('padre_nombre');
    let apellidoP = getIDInput('padre_apellidoP');
    let apellidoM = getIDInput('padre_apellidoM');
    let fechaNac = getIDInput('padre_fechaNac');
    let sexo = getIDInput('padre_sexo');
    let email = getIDInput('padre_email');
    let rol = getIDInput('padre_rol');
    let telefono = getIDInput('padre_telefono');
    let clave1 = getIDInput('padre_clave_1');
    let clave2 = getIDInput('padre_clave_2');

    let message_ci = ''
    let message_nombre = ''
    let message_apellidoP = ''
    let message_apellidoM = ''
    let message_fechaNac = ''
    let message_sexo = ''
    let message_rol = ''
    let message_email = ''
    let message_telefono = ''
    let message_clave1 = ''
    let message_clave2 = ''

    let enviar = true;

    if(ci.value === null || ci.value === ''){
        message_ci = 'Este campo es requerido'
        enviar = false;
    }else if(!ci.value.match(/^[0-9-]/)){
        message_ci = 'El CI no coincide con el formato solicitado'
        enviar = false;
    }else if (ci.value.length < 5 || ci.value.length > 15) {
        message_ci = 'El CI debe ser mayor a 5 digitos'
        enviar = false; 
    }

    if(nombre.value === null || nombre.value === ''){
        message_nombre = 'Este campo es requerido'
        enviar = false;
    }else if(!nombre.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_nombre = 'El NOMBRE no coincide con el formato solicitado'
        enviar = false;
    }else if (nombre.value.length < 3 || nombre.value.length > 30) {
        message_nombre = 'El NOMBRE debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(apellidoP.value === null || apellidoP.value === ''){
        message_apellidoP = 'Este campo es requerido'
        enviar = false;
    }else if(!apellidoP.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_apellidoP = 'El APELLIDO PATERNO no coincide con el formato solicitado'
        enviar = false;
    }else if (apellidoP.value.length < 3 || apellidoP.value.length > 50) {
        message_apellidoP = 'El APELLIDO PATERNO debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(apellidoM.value === null || apellidoM.value === ''){
        message_apellidoM = 'Este campo es requerido'
        enviar = false;
    }else if(!apellidoM.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_apellidoM = 'El APELLIDO MATERNO no coincide con el formato solicitado'
        enviar = false;
    }else if (apellidoM.value.length < 3 || apellidoM.value.length > 50) {
        message_apellidoM = 'El APELLIDO MATERNO debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(fechaNac.value === null || fechaNac.value === ''){
        message_fechaNac = 'Este campo es requerido'
        enviar = false;
    }

    if(sexo.value === null || sexo.value === ''){
        message_sexo = 'Este campo es requerido'
        enviar = false;
    }

    if(email.value !== '' && !validateEmail(email.value)){
        message_email = 'Ha ingresado un CORREO no valido'
        enviar = false;
    }

    if(rol.value === null || rol.value === ''){
        message_rol = 'Este campo es requerido'
        enviar = false;
    }else if(!rol.value.match(/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]/)){
        message_rol = 'El ROL no coincide con el formato solicitado'
        enviar = false;
    }else if (rol.value.length < 3 || rol.value.length > 50) {
        message_rol = 'El ROL debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(telefono.value === null || telefono.value === ''){
        message_telefono = 'Este campo es requerido'
        enviar = false;
    }else if(!telefono.value.match(/^[0-9()+]/)){
        message_telefono = 'El TELEFONO no coincide con el formato solicitado'
        enviar = false;
    }else if (telefono.value.length < 7 || telefono.value.length > 15) {
        message_telefono = 'El TELEFONO debe ser mayor a 7 digitos'
        enviar = false; 
    }

    if(clave1.value === null || clave1.value === ''){
        message_clave1 = 'Este campo es requerido'
        enviar = false;
    }else if(!clave1.value.match(/^[a-zA-Z0-9@#$%&.-]/)){
        message_clave1 = 'La CONTRASEÑA no coincide con el formato solicitado'
        enviar = false;
    }else if (clave1.value.length < 7 || clave1.value.length > 20) {
        message_clave1 = 'La CONTRASEÑA debe ser mayor a 7 digitos'
        enviar = false; 
    }

    if(clave2.value === null || clave2.value === ''){
        message_clave2 = 'Este campo es requerido'
        enviar = false;
    }else if(!clave2.value.match(/^[a-zA-Z0-9@#$%&.-]/)){
        message_clave2 = 'El CONTRASEÑA no coincide con el formato solicitado'
        enviar = false;
    }else if (clave2.value.length < 7 || clave2.value.length > 20) {
        message_clave2 = 'El CONTRASEÑA debe ser mayor a 7 digitos'
        enviar = false; 
    }

    if(clave1.value !== clave2.value){
        message_clave2 = 'La CONTRASEÑA que acaba de ingresar no coinciden'
    }

    getIDInput("padre_ci_error").innerHTML = message_ci;  
    getIDInput("padre_nombre_error").innerHTML = message_nombre;
    getIDInput("padre_apellidoP_error").innerHTML = message_apellidoP;  
    getIDInput("padre_apellidoM_error").innerHTML = message_apellidoM;
    getIDInput("padre_fechaNac_error").innerHTML = message_fechaNac;  
    getIDInput("padre_sexo_error").innerHTML = message_sexo;
    getIDInput("padre_email_error").innerHTML = message_email;
    getIDInput("padre_rol_error").innerHTML = message_rol;    
    getIDInput("padre_telefono_error").innerHTML = message_telefono;
    getIDInput("padre_clave_1_error").innerHTML = message_clave1;  
    getIDInput("padre_clave_2_error").innerHTML = message_clave2;

    return enviar;
}

function parent_update_validata() {
    let ci = getIDInput('padre_ci');
    let nombre = getIDInput('padre_nombre');
    let apellidoP = getIDInput('padre_apellidoP');
    let apellidoM = getIDInput('padre_apellidoM');
    let fechaNac = getIDInput('padre_fecha_nac');
    let sexo = getIDInput('padre_sexo');
    let rol = getIDInput('padre_rol');
    let email = getIDInput('padre_email');
    let telefono = getIDInput('padre_telefono');
    let clave1 = getIDInput('padre_clave_nueva_1');
    let clave2 = getIDInput('padre_clave_nueva_2');

    let message_ci = ''
    let message_nombre = ''
    let message_apellidoP = ''
    let message_apellidoM = ''
    let message_fechaNac = ''
    let message_sexo = ''
    let message_rol = ''
    let message_email = ''
    let message_telefono = ''
    let message_clave1 = ''
    let message_clave2 = ''

    let enviar = true;

    if(ci.value === null || ci.value === ''){
        message_ci = 'Este campo es requerido'
        enviar = false;
    }else if(!ci.value.match(/^[0-9-]/)){
        message_ci = 'El CI no coincide con el formato solicitado'
        enviar = false;
    }else if(ci.value.length < 5 || ci.value.length > 15) {
        message_ci = 'El CI debe ser mayor a 5 digitos'
        enviar = false; 
    }

    if(nombre.value === null || nombre.value === ''){
        message_nombre = 'Este campo es requerido'
        enviar = false;
    }else if(!nombre.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_nombre = 'El NOMBRE no coincide con el formato solicitado'
        enviar = false;
    }else if (nombre.value.length < 3 || nombre.value.length > 30) {
        message_nombre = 'El NOMBRE debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(apellidoP.value === null || apellidoP.value === ''){
        message_apellidoP = 'Este campo es requerido'
        enviar = false;
    }else if(!apellidoP.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_apellidoP = 'El APELLIDO PATERNO no coincide con el formato solicitado'
        enviar = false;
    }else if (apellidoP.value.length < 3 || apellidoP.value.length > 30) {
        message_apellidoP = 'El APELLIDO PATERNO debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(apellidoM.value === null || apellidoM.value === ''){
        message_apellidoM = 'Este campo es requerido'
        enviar = false;
    }else if(!apellidoM.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_apellidoM = 'El APELLIDO MATERNO no coincide con el formato solicitado'
        enviar = false;
    }else if (apellidoM.value.length < 3 || apellidoM.value.length > 30) {
        message_apellidoM = 'El APELLIDO MATERNO debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(fechaNac.value === null || fechaNac.value === ''){
        message_fechaNac = 'Este campo es requerido'
        enviar = false;
    }

    if(sexo.value === null || sexo.value === ''){
        message_sexo = 'Este campo es requerido'
        enviar = false;
    }

    if(rol.value === null || rol.value === ''){
        message_rol = 'Este campo es requerido'
        enviar = false;
    }else if(!rol.value.match(/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]/)){
        message_rol = 'El ROL no coincide con el formato solicitado'
        enviar = false;
    }else if (rol.value.length < 3 || rol.value.length > 50) {
        message_rol = 'El ROL debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(email.value !== '' && !validateEmail(email.value)){
        message_email = 'Ha ingresado un CORREO no valido'
        enviar = false;
    }

    if(telefono.value === null || telefono.value === ''){
        message_telefono = 'Este campo es requerido'
        enviar = false;
    }else if(!telefono.value.match(/^[0-9()+]/)){
        message_telefono = 'El TELEFONO no coincide con el formato solicitado'
        enviar = false;
    }else if (telefono.value.length < 7 || telefono.value.length > 15) {
        message_telefono = 'El TELEFONO debe ser mayor a 7 digitos'
        enviar = false; 
    }

    if(clave1.value !== '' && !clave1.value.match(/^[a-zA-Z0-9@#$%&.-]/)){
        message_clave1 = 'La CONTRASEÑA no coincide con el formato solicitado'
        enviar = false;
    }else if (clave1.value !== '' && clave1.value.length < 7 || clave1.value.length > 20) {
        message_clave1 = 'La CONTRASEÑA debe ser mayor a 7 digitos'
        enviar = false; 
    }

    if(clave2.value !== '' && !clave2.value.match(/^[a-zA-Z0-9@#$%&.-]/)){
        message_clave2 = 'El CONTRASEÑA no coincide con el formato solicitado'
        enviar = false;
    }else if (clave2.value !== '' && clave2.value.length < 7 || clave2.value.length > 20) {
        message_clave2 = 'El CONTRASEÑA debe ser mayor a 7 digitos'
        enviar = false; 
    }
    
    if(clave2.value !== '' && clave2.value !== '' && clave1.value !== clave2.value){
        message_clave2 = 'La CONTRASEÑA que acaba de ingresar no coinciden'
    }

    getIDInput("padre_ci_error").innerHTML = message_ci;  
    getIDInput("padre_nombre_error").innerHTML = message_nombre;
    getIDInput("padre_apellidoP_error").innerHTML = message_apellidoP;  
    getIDInput("padre_apellidoM_error").innerHTML = message_apellidoM;
    getIDInput("padre_fechaNac_error").innerHTML = message_fechaNac;  
    getIDInput("padre_sexo_error").innerHTML = message_sexo;
    getIDInput("padre_rol_error").innerHTML = message_rol;    
    getIDInput("padre_email_error").innerHTML = message_email;  
    getIDInput("padre_telefono_error").innerHTML = message_telefono;
    getIDInput("padre_clave_nueva_1_error").innerHTML = message_clave1;  
    getIDInput("padre_clave_nueva_2_error").innerHTML = message_clave2;

    return enviar;
}

/* VALIDATION INPUTS TEACHER FORM */

function teacher_new_validata() {
    let ci = getIDInput('docente_ci');
    let nombre = getIDInput('docente_nombre');
    let apellidoP = getIDInput('docente_apellidoP');
    let apellidoM = getIDInput('docente_apellidoM');
    let fechaNac = getIDInput('docente_fechaNac');
    let sexo = getIDInput('docente_sexo');
    let fechaIng = getIDInput('docente_fechaIng');
    let telefono = getIDInput('docente_telefono');
    let direccion = getIDInput('docente_direccion');
    let email = getIDInput('docente_email');
    let clave1 = getIDInput('docente_clave_1');
    let clave2 = getIDInput('docente_clave_2');
    let area = getIDInput('docente_id_area');

    let message_ci = ''
    let message_nombre = ''
    let message_apellidoP = ''
    let message_apellidoM = ''
    let message_fechaNac = ''
    let message_sexo = ''
    let message_fechaIng = ''
    let message_telefono = ''
    let message_direccion = ''
    let message_email = ''
    let message_clave1 = ''
    let message_clave2 = ''
    let message_area = ''

    let enviar = true;

    if(ci.value === null || ci.value === ''){
        message_ci = 'Este campo es requerido'
        enviar = false;
    }else if(!ci.value.match(/^[0-9-]/)){
        message_ci = 'El CI no coincide con el formato solicitado'
        enviar = false;
    }else if (ci.value.length < 5 || ci.value.length > 15) {
        message_ci = 'El CI debe ser mayor a 5 digitos'
        enviar = false; 
    }

    if(nombre.value === null || nombre.value === ''){
        message_nombre = 'Este campo es requerido'
        enviar = false;
    }else if(!nombre.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_nombre = 'El NOMBRE no coincide con el formato solicitado'
        enviar = false;
    }else if (nombre.value.length < 3 || nombre.value.length > 30) {
        message_nombre = 'El NOMBRE debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(apellidoP.value === null || apellidoP.value === ''){
        message_apellidoP = 'Este campo es requerido'
        enviar = false;
    }else if(!apellidoP.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_apellidoP = 'El APELLIDO PATERNO no coincide con el formato solicitado'
        enviar = false;
    }else if (apellidoP.value.length < 3 || apellidoP.value.length > 50) {
        message_apellidoP = 'El APELLIDO PATERNO debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(apellidoM.value === null || apellidoM.value === ''){
        message_apellidoM = 'Este campo es requerido'
        enviar = false;
    }else if(!apellidoM.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_apellidoM = 'El APELLIDO MATERNO no coincide con el formato solicitado'
        enviar = false;
    }else if (apellidoM.value.length < 3 || apellidoM.value.length > 50) {
        message_apellidoM = 'El APELLIDO MATERNO debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(fechaNac.value === null || fechaNac.value === ''){
        message_fechaNac = 'Este campo es requerido'
        enviar = false;
    }

    if(sexo.value === null || sexo.value === ''){
        message_sexo = 'Este campo es requerido'
        enviar = false;
    }

    if(fechaIng.value === null || fechaIng.value === ''){
        message_fechaIng = 'Este campo es requerido'
        enviar = false;
    }

    if(telefono.value === null || telefono.value === ''){
        message_telefono = 'Este campo es requerido'
        enviar = false;
    }else if(!telefono.value.match(/^[0-9()+]/)){
        message_telefono = 'El TELEFONO no coincide con el formato solicitado'
        enviar = false;
    }else if (telefono.value.length < 7 || telefono.value.length > 15) {
        message_telefono = 'El TELEFONO debe ser mayor a 7 digitos'
        enviar = false; 
    }

    if(direccion.value !== '' && !direccion.value.match(/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]/)){
        message_direccion = 'La DIRECCION no coincide con el formato solicitado'
        enviar = false;
    }else if (direccion.value !== '' &&  direccion.value.length < 3 || direccion.value.length > 150) {
        message_direccion = 'La DIRECCION debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(email.value === null || email.value === ''){
        message_email = 'Este campo es requerido'
        enviar = false;
    }else if(!validateEmail(email.value)){
        message_email = 'Ha ingresado un CORREO no valido'
        enviar = false;
    } 

    if(clave1.value === null || clave1.value === ''){
        message_clave1 = 'Este campo es requerido'
        enviar = false;
    }else if(!clave1.value.match(/^[a-zA-Z0-9@#$%&.-]/)){
        message_clave1 = 'La CONTRASEÑA no coincide con el formato solicitado'
        enviar = false;
    }else if (clave1.value.length < 7 || clave1.value.length > 20) {
        message_clave1 = 'La CONTRASEÑA debe ser mayor a 7 digitos'
        enviar = false; 
    }

    if(clave2.value === null || clave2.value === ''){
        message_clave2 = 'Este campo es requerido'
        enviar = false;
    }else if(!clave2.value.match(/^[a-zA-Z0-9@#$%&.-]/)){
        message_clave2 = 'El CONTRASEÑA no coincide con el formato solicitado'
        enviar = false;
    }else if (clave2.value.length < 7 || clave2.value.length > 20) {
        message_clave2 = 'El CONTRASEÑA debe ser mayor a 7 digitos'
        enviar = false; 
    }

    if(clave1.value !== clave2.value){
        message_clave2 = 'La CONTRASEÑA que acaba de ingresar no coinciden'
    }

    if(area.value === null || area.value === ''){
        message_area = 'Este campo es requerido'
        enviar = false;
    }

    getIDInput("docente_ci_error").innerHTML = message_ci;  
    getIDInput("docente_nombre_error").innerHTML = message_nombre;
    getIDInput("docente_apellidoP_error").innerHTML = message_apellidoP;  
    getIDInput("docente_apellidoM_error").innerHTML = message_apellidoM;
    getIDInput("docente_fechaNac_error").innerHTML = message_fechaNac;  
    getIDInput("docente_sexo_error").innerHTML = message_sexo;
    getIDInput("docente_fechaIng_error").innerHTML = message_fechaIng;
    getIDInput("docente_telefono_error").innerHTML = message_telefono;
    getIDInput("docente_direccion_error").innerHTML = message_direccion;
    getIDInput("docente_email_error").innerHTML = message_email;    
    getIDInput("docente_clave_1_error").innerHTML = message_clave1;  
    getIDInput("docente_clave_2_error").innerHTML = message_clave2;
    getIDInput("docente_id_area_error").innerHTML = message_area;

    return enviar;
}

function teacher_update_validata() {
    let ci = getIDInput('docente_ci');
    let nombre = getIDInput('docente_nombre');
    let apellidoP = getIDInput('docente_apellidoP');
    let apellidoM = getIDInput('docente_apellidoM');
    let fechaNac = getIDInput('docente_fecha_nac');
    let sexo = getIDInput('docente_sexo');
    let fechaIng = getIDInput('docente_fechaIng');
    let telefono = getIDInput('docente_telefono');
    let direccion = getIDInput('docente_direccion');
    let email = getIDInput('docente_email');
    let educativo = getIDInput('docente_id_educativo');
    let area = getIDInput('docente_id_area');
    let clave1 = getIDInput('docente_clave_nueva_1');
    let clave2 = getIDInput('docente_clave_nueva_2');

    let message_ci = ''
    let message_nombre = ''
    let message_apellidoP = ''
    let message_apellidoM = ''
    let message_fechaNac = ''
    let message_sexo = ''
    let message_fechaIng = ''
    let message_telefono = ''
    let message_direccion = ''
    let message_email = ''
    let message_clave1 = ''
    let message_clave2 = ''
    let message_area = ''
    let message_educativo = ''

    let enviar = true;

    if(ci.value === null || ci.value === ''){
        message_ci = 'Este campo es requerido'
        enviar = false;
    }else if(!ci.value.match(/^[0-9-]/)){
        message_ci = 'El CI no coincide con el formato solicitado'
        enviar = false;
    }else if (ci.value.length < 5 || ci.value.length > 15) {
        message_ci = 'El CI debe ser mayor a 5 digitos'
        enviar = false; 
    }

    if(nombre.value === null || nombre.value === ''){
        message_nombre = 'Este campo es requerido'
        enviar = false;
    }else if(!nombre.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_nombre = 'El NOMBRE no coincide con el formato solicitado'
        enviar = false;
    }else if (nombre.value.length < 3 || nombre.value.length > 30) {
        message_nombre = 'El NOMBRE debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(apellidoP.value === null || apellidoP.value === ''){
        message_apellidoP = 'Este campo es requerido'
        enviar = false;
    }else if(!apellidoP.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_apellidoP = 'El APELLIDO PATERNO no coincide con el formato solicitado'
        enviar = false;
    }else if (apellidoP.value.length < 3 || apellidoP.value.length > 50) {
        message_apellidoP = 'El APELLIDO PATERNO debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(apellidoM.value === null || apellidoM.value === ''){
        message_apellidoM = 'Este campo es requerido'
        enviar = false;
    }else if(!apellidoM.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_apellidoM = 'El APELLIDO MATERNO no coincide con el formato solicitado'
        enviar = false;
    }else if (apellidoM.value.length < 3 || apellidoM.value.length > 50) {
        message_apellidoM = 'El APELLIDO MATERNO debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(fechaNac.value === null || fechaNac.value === ''){
        message_fechaNac = 'Este campo es requerido'
        enviar = false;
    }

    if(sexo.value === null || sexo.value === ''){
        message_sexo = 'Este campo es requerido'
        enviar = false;
    }

    if(fechaIng.value === null || fechaIng.value === ''){
        message_fechaIng = 'Este campo es requerido'
        enviar = false;
    }

    if(telefono.value === null || telefono.value === ''){
        message_telefono = 'Este campo es requerido'
        enviar = false;
    }else if(!telefono.value.match(/^[0-9()+]/)){
        message_telefono = 'El TELEFONO no coincide con el formato solicitado'
        enviar = false;
    }else if (telefono.value.length < 7 || telefono.value.length > 15) {
        message_telefono = 'El TELEFONO debe ser mayor a 7 digitos'
        enviar = false; 
    }

    if(direccion.value !== '' && !direccion.value.match(/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]/)){
        message_direccion = 'La DIRECCION no coincide con el formato solicitado'
        enviar = false;
    }else if (direccion.value !== '' &&  direccion.value.length < 3 || direccion.value.length > 150) {
        message_direccion = 'La DIRECCION debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(email.value === null || email.value === ''){
        message_email = 'Este campo es requerido'
        enviar = false;
    }else if(!validateEmail(email.value)){
        message_email = 'Ha ingresado un CORREO no valido'
        enviar = false;
    } 

    if(clave1.value !== '' && !clave1.value.match(/^[a-zA-Z0-9@#$%&.-]/)){
        message_clave1 = 'La CONTRASEÑA no coincide con el formato solicitado'
        enviar = false;
    }else if (clave1.value !== '' && clave1.value.length < 7 || clave1.value.length > 20) {
        message_clave1 = 'La CONTRASEÑA debe ser mayor a 7 digitos'
        enviar = false; 
    }

    if(clave2.value !== '' &&  !clave2.value.match(/^[a-zA-Z0-9@#$%&.-]/)){
        message_clave2 = 'El CONTRASEÑA no coincide con el formato solicitado'
        enviar = false;
    }else if (clave2.value !== '' &&  clave2.value.length < 7 || clave2.value.length > 20) {
        message_clave2 = 'El CONTRASEÑA debe ser mayor a 7 digitos'
        enviar = false; 
    }

    if(clave1.value !== '' && clave2.value !== '' && clave1.value !== clave2.value){
        message_clave2 = 'La CONTRASEÑA que acaba de ingresar no coinciden'
    }

    if(area.value === null || area.value === ''){
        message_area = 'Este campo es requerido'
        enviar = false;
    }

    if(educativo.value === null || educativo.value === ''){
        message_educativo = 'Este campo es requerido'
        enviar = false;
    }

    getIDInput("docente_ci_error").innerHTML = message_ci;  
    getIDInput("docente_nombre_error").innerHTML = message_nombre;
    getIDInput("docente_apellidoP_error").innerHTML = message_apellidoP;  
    getIDInput("docente_apellidoM_error").innerHTML = message_apellidoM;
    getIDInput("docente_fecha_nac_error").innerHTML = message_fechaNac;  
    getIDInput("docente_sexo_error").innerHTML = message_sexo;
    getIDInput("docente_fechaIng_error").innerHTML = message_fechaIng;
    getIDInput("docente_telefono_error").innerHTML = message_telefono;
    getIDInput("docente_direccion_error").innerHTML = message_direccion;
    getIDInput("docente_email_error").innerHTML = message_email;    
    getIDInput("docente_clave_nueva_1_error").innerHTML = message_clave1;  
    getIDInput("docente_clave_nueva_2_error").innerHTML = message_clave2;
    getIDInput("docente_id_educativo_error").innerHTML = message_educativo;
    getIDInput("docente_id_area_error").innerHTML = message_area;

    return enviar;
}

/* VALIDATION INPUTS COURSE FORM */

function course_new_validata() {
    let turno = getIDInput('curso_turno');
    let grado = getIDInput('curso_grado');
    let seccion = getIDInput('curso_seccion');
    let capacidad = getIDInput('curso_capacidad');

    let message_turno = ''
    let message_grado = ''
    let message_seccion = ''
    let message_capacidad = ''

    let enviar = true;

    if(turno.value === null || turno.value === ''){
        message_turno = 'Este campo es requerido'
        enviar = false;
    }else if (turno.value !== 'Mañana' && turno.value !== 'Tarde' && turno.value !== 'Noche') {
        message_turno = 'El TURNO no coincide con el formato solicitado'
        enviar = false; 
    }

    if(grado.value === null || grado.value === ''){
        message_grado = 'Este campo es requerido'
        enviar = false;
    }else if (grado.value !== 'Primero' && grado.value !== 'Segundo' && grado.value !== 'Tercero' 
            && grado.value !== 'Cuarto' && grado.value !== 'Quinto' && grado.value !== 'Sexto') {
        message_grado = 'El GRADO no coincide con el formato solicitado'
        enviar = false; 
    }

    if(seccion.value === null || seccion.value === ''){
        message_seccion = 'Este campo es requerido'
        enviar = false;
    }else if (seccion.value !== 'A' && seccion.value !== 'B' && seccion.value !== 'C'
            && seccion.value !== 'D' && seccion.value !== 'E' && seccion.value !== 'F'
            && seccion.value !== 'G' && seccion.value !== 'H' && seccion.value !== 'I'
            && seccion.value !== 'J' && seccion.value !== 'K' && seccion.value !== 'L' && seccion.value !== 'M') {
        message_seccion = 'La SECCION no coincide con el formato solicitado'
        enviar = false; 
    }

    if(capacidad.value === null || capacidad.value === ''){
        message_capacidad = 'Este campo es requerido'
        enviar = false;
    }else if(!capacidad.value.match(/^[0-9]/)){
        message_capacidad = 'La CAPACIDAD no coincide con el formato solicitado'
        enviar = false;
    }else if (capacidad.value.length < 1 || capacidad.value.length > 2) {
        message_capacidad = 'La CAPACIDAD debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    getIDInput("curso_turno_error").innerHTML = message_turno;  
    getIDInput("curso_grado_error").innerHTML = message_grado;
    getIDInput("curso_seccion_error").innerHTML = message_seccion;  
    getIDInput("curso_capacidad_error").innerHTML = message_capacidad;

    return enviar;
}

/* VALIDATION INPUTS PERIOD FORM */

function period_new_validata() {
    let nombre = getIDInput('periodo_nombre');
    let message_nombre = ''
    let enviar = true;


    if(nombre.value === null || nombre.value === ''){
        message_nombre = 'Este campo es requerido'
        enviar = false;
    }else if(!nombre.value.match(/^[a-zA-záéíóúÁÉÍÓÚñÑ0-9 ]/)){
        message_nombre = 'El NOMBRE no coincide con el formato solicitado'
        enviar = false;
    }else if (nombre.value.length < 1 || nombre.value.length > 50) {
        message_nombre = 'El NOMBRE debe ser mayor a 1 caracteres'
        enviar = false; 
    }

    getIDInput("periodo_nombre_error").innerHTML = message_nombre;  
    return enviar;
}

/* VALIDATION INPUTS AREA FORM */

function area_new_validata() {
    let nombre = getIDInput('area_nombre');
    let info = getIDInput('area_info');
    let campo = getIDInput('area_campo');
    let message_nombre = ''
    let message_info = ''
    let message_campo = ''
    let enviar = true;


    if(nombre.value === null || nombre.value === ''){
        message_nombre = 'Este campo es requerido'
        enviar = false;
    }else if(!nombre.value.match(/^[a-zA-záéíóúÁÉÍÓÚñÑ0-9 ]/)){
        message_nombre = 'El NOMBRE no coincide con el formato solicitado'
        enviar = false;
    }else if (nombre.value.length < 1 || nombre.value.length > 50) {
        message_nombre = 'El NOMBRE debe ser mayor a 1 caracteres'
        enviar = false; 
    }

    if(info.value !== '' && !info.value.match(/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]/)){
        message_info = 'La INFORMACION no coincide con el formato solicitado'
        enviar = false;
    }else if (info.value !== '' && info.value.length < 3 || info.value.length > 255) {
        message_info = 'La INFORMACION debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(campo.value === null || campo.value === ''){
        message_campo = 'Este campo es requerido'
        enviar = false;
    }

    getIDInput("area_nombre_error").innerHTML = message_nombre;  
    getIDInput("area_info_error").innerHTML = message_info  
    getIDInput("area_campo_error").innerHTML = message_campo  
    return enviar;
}

/* VALIDATION INPUTS YEAR FORM */

function year_new_validata() {
    let nombre = getIDInput('anio_nombre');
    let message_nombre = ''
    let enviar = true;


    if(nombre.value === null || nombre.value === ''){
        message_nombre = 'Este campo es requerido'
        enviar = false;
    }else if(!nombre.value.match(/^[a-zA-záéíóúÁÉÍÓÚñÑ0-9 ]/)){
        message_nombre = 'El NOMBRE no coincide con el formato solicitado'
        enviar = false;
    }else if (nombre.value.length < 4 || nombre.value.length > 5) {
        message_nombre = 'El NOMBRE debe ser mayor a 4 caracteres'
        enviar = false; 
    }

    getIDInput("anio_nombre_error").innerHTML = message_nombre;  
    return enviar;
}

/* VALIDATION INPUTS ADMIN FORM */

function admin_new_validata() {
    let nombre = getIDInput('usuario_nombre');
    let apellidoP = getIDInput('usuario_apellidoP');
    let apellidoM = getIDInput('usuario_apellidoM');
    let telefono = getIDInput('usuario_telefono');
    let direccion = getIDInput('usuario_direccion');
    let tipo = getIDInput('usuario_tipo');
    let email = getIDInput('usuario_email');
    let clave1 = getIDInput('usuario_clave_1');
    let clave2 = getIDInput('usuario_clave_2');
    let privilegio = getIDInput('usuario_privilegio');

    let message_nombre = ''
    let message_apellidoP = ''
    let message_apellidoM = ''
    let message_tipo = ''
    let message_privilegio = ''
    let message_direccion = ''
    let message_email = ''
    let message_telefono = ''
    let message_clave1 = ''
    let message_clave2 = ''

    let enviar = true;

    if(nombre.value === null || nombre.value === ''){
        message_nombre = 'Este campo es requerido'
        enviar = false;
    }else if(!nombre.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_nombre = 'El NOMBRE no coincide con el formato solicitado'
        enviar = false;
    }else if (nombre.value.length < 3 || nombre.value.length > 30) {
        message_nombre = 'El NOMBRE debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(apellidoP.value === null || apellidoP.value === ''){
        message_apellidoP = 'Este campo es requerido'
        enviar = false;
    }else if(!apellidoP.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_apellidoP = 'El APELLIDO PATERNO no coincide con el formato solicitado'
        enviar = false;
    }else if (apellidoP.value.length < 3 || apellidoP.value.length > 50) {
        message_apellidoP = 'El APELLIDO PATERNO debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(apellidoM.value === null || apellidoM.value === ''){
        message_apellidoM = 'Este campo es requerido'
        enviar = false;
    }else if(!apellidoM.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_apellidoM = 'El APELLIDO MATERNO no coincide con el formato solicitado'
        enviar = false;
    }else if (apellidoM.value.length < 3 || apellidoM.value.length > 50) {
        message_apellidoM = 'El APELLIDO MATERNO debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(telefono.value !== '' && !telefono.value.match(/^[0-9()+]/)){
        message_telefono = 'El TELEFONO no coincide con el formato solicitado'
        enviar = false;
    }else if (telefono.value !== '' && telefono.value.length < 7 || telefono.value.length > 15) {
        message_telefono = 'El TELEFONO debe ser mayor a 7 digitos'
        enviar = false; 
    }

    if(direccion.value !== '' && !direccion.value.match(/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]/)){
        message_direccion = 'La DIRECCION no coincide con el formato solicitado'
        enviar = false;
    }else if (direccion.value !== '' && direccion.value.length < 1 || direccion.value.length > 255) {
        message_direccion = 'La DIRECCION debe ser mayor a 1 caracteres'
        enviar = false; 
    }

    if(tipo.value === null || tipo.value === ''){
        message_tipo = 'Este campo es requerido'
        enviar = false;
    }else  if (tipo.value !== 'Administrador' && tipo.value !== 'Director') {
        message_tipo = 'El TIPO DE USUARIO no coincide con el formato solicitado'
        enviar = false; 
    }

    if(email.value === null || email.value === ''){
        message_email = 'Este campo es requerido'
        enviar = false;
    }else if(!validateEmail(email.value)){
        message_email = 'Ha ingresado un CORREO no valido'
        enviar = false;
    }

    if(clave1.value === null || clave1.value === ''){
        message_clave1 = 'Este campo es requerido'
        enviar = false;
    }else if(!clave1.value.match(/^[a-zA-Z0-9@#$%&.-]/)){
        message_clave1 = 'La CONTRASEÑA no coincide con el formato solicitado'
        enviar = false;
    }else if (clave1.value.length < 7 || clave1.value.length > 20) {
        message_clave1 = 'La CONTRASEÑA debe ser mayor a 7 digitos'
        enviar = false; 
    }

    if(clave2.value === null || clave2.value === ''){
        message_clave2 = 'Este campo es requerido'
        enviar = false;
    }else if(!clave2.value.match(/^[a-zA-Z0-9@#$%&.-]/)){
        message_clave2 = 'El CONTRASEÑA no coincide con el formato solicitado'
        enviar = false;
    }else if (clave2.value.length < 7 || clave2.value.length > 20) {
        message_clave2 = 'El CONTRASEÑA debe ser mayor a 7 digitos'
        enviar = false; 
    }

    if(clave1.value !== clave2.value){
        message_clave2 = 'La CONTRASEÑA que acaba de ingresar no coinciden'
    }

    if(privilegio.value === null || privilegio.value === ''){
        message_privilegio = 'Este campo es requerido'
        enviar = false;
    }

    getIDInput("usuario_nombre_error").innerHTML = message_nombre;
    getIDInput("usuario_apellidoP_error").innerHTML = message_apellidoP;  
    getIDInput("usuario_apellidoM_error").innerHTML = message_apellidoM;
    getIDInput("usuario_direccion_error").innerHTML = message_direccion;  
    getIDInput("usuario_tipo_error").innerHTML = message_tipo;
    getIDInput("usuario_email_error").innerHTML = message_email;
    getIDInput("usuario_privilegio_error").innerHTML = message_privilegio;    
    getIDInput("usuario_telefono_error").innerHTML = message_telefono;
    getIDInput("usuario_clave_1_error").innerHTML = message_clave1;  
    getIDInput("usuario_clave_2_error").innerHTML = message_clave2;

    return enviar;
}

function admin_update_validata() {
    let nombre = getIDInput('usuario_nombre');
    let apellidoP = getIDInput('usuario_apellidoP');
    let apellidoM = getIDInput('usuario_apellidoM');
    let telefono = getIDInput('usuario_telefono');
    let direccion = getIDInput('usuario_direccion');
    let tipo = getIDInput('usuario_tipo');
    let email = getIDInput('usuario_email');
    let clave1 = getIDInput('usuario_clave_nueva_1');
    let clave2 = getIDInput('usuario_clave_nueva_2');
    let privilegio = getIDInput('usuario_privilegio');
    let admin_email = getIDInput('email_admin');
    let admin_clave = getIDInput('clave_admin');

    let message_nombre = ''
    let message_apellidoP = ''
    let message_apellidoM = ''
    let message_tipo = ''
    let message_privilegio = ''
    let message_direccion = ''
    let message_email = ''
    let message_telefono = ''
    let message_clave1 = ''
    let message_clave2 = ''
    let message_admin_email = ''
    let message_admin_clave = ''

    let enviar = true;

    if(nombre.value === null || nombre.value === ''){
        message_nombre = 'Este campo es requerido'
        enviar = false;
    }else if(!nombre.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_nombre = 'El NOMBRE no coincide con el formato solicitado'
        enviar = false;
    }else if (nombre.value.length < 3 || nombre.value.length > 30) {
        message_nombre = 'El NOMBRE debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(apellidoP.value === null || apellidoP.value === ''){
        message_apellidoP = 'Este campo es requerido'
        enviar = false;
    }else if(!apellidoP.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_apellidoP = 'El APELLIDO PATERNO no coincide con el formato solicitado'
        enviar = false;
    }else if (apellidoP.value.length < 3 || apellidoP.value.length > 50) {
        message_apellidoP = 'El APELLIDO PATERNO debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(apellidoM.value === null || apellidoM.value === ''){
        message_apellidoM = 'Este campo es requerido'
        enviar = false;
    }else if(!apellidoM.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_apellidoM = 'El APELLIDO MATERNO no coincide con el formato solicitado'
        enviar = false;
    }else if (apellidoM.value.length < 3 || apellidoM.value.length > 50) {
        message_apellidoM = 'El APELLIDO MATERNO debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(telefono.value !== '' && !telefono.value.match(/^[0-9()+]/)){
        message_telefono = 'El TELEFONO no coincide con el formato solicitado'
        enviar = false;
    }else if (telefono.value !== '' && telefono.value.length < 7 || telefono.value.length > 15) {
        message_telefono = 'El TELEFONO debe ser mayor a 7 digitos'
        enviar = false; 
    }

    if(direccion.value !== '' && !direccion.value.match(/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]/)){
        message_direccion = 'La DIRECCION no coincide con el formato solicitado'
        enviar = false;
    }else if (direccion.value !== '' && direccion.value.length < 1 || direccion.value.length > 255) {
        message_direccion = 'La DIRECCION debe ser mayor a 1 caracteres'
        enviar = false; 
    }

    if(tipo.value === null || tipo.value === ''){
        message_tipo = 'Este campo es requerido'
        enviar = false;
    }else  if (tipo.value !== 'Administrador' && tipo.value !== 'Director') {
        message_tipo = 'El TIPO DE USUARIO no coincide con el formato solicitado'
        enviar = false; 
    }

    if(email.value === null || email.value === ''){
        message_email = 'Este campo es requerido'
        enviar = false;
    }else if(!validateEmail(email.value)){
        message_email = 'Ha ingresado un CORREO no valido'
        enviar = false;
    }

    if(clave1.value !== '' && !clave1.value.match(/^[a-zA-Z0-9@#$%&.-]/)){
        message_clave1 = 'La CONTRASEÑA no coincide con el formato solicitado'
        enviar = false;
    }else if (clave1.value !== '' &&  clave1.value.length < 7 || clave1.value.length > 20) {
        message_clave1 = 'La CONTRASEÑA debe ser mayor a 7 digitos'
        enviar = false; 
    }

    if(clave2.value !== '' && !clave2.value.match(/^[a-zA-Z0-9@#$%&.-]/)){
        message_clave2 = 'El CONTRASEÑA no coincide con el formato solicitado'
        enviar = false;
    }else if (clave2.value !== '' && clave2.value.length < 7 || clave2.value.length > 20) {
        message_clave2 = 'El CONTRASEÑA debe ser mayor a 7 digitos'
        enviar = false; 
    }

    if(clave1.value !== clave2.value){
        message_clave2 = 'La CONTRASEÑA que acaba de ingresar no coinciden'
    }

    if(privilegio.value === null || privilegio.value === ''){
        message_privilegio = 'Este campo es requerido'
        enviar = false;
    }

    if(admin_email.value === null || admin_email.value === ''){
        message_admin_email = 'Este campo es requerido'
        enviar = false;
    }else if(!validateEmail(admin_email.value)){
        message_admin_email = 'Ha ingresado un CORREO no valido'
        enviar = false;
    }

    if(admin_clave.value === null || admin_clave.value === ''){
        message_admin_clave = 'Este campo es requerido'
        enviar = false;
    }else if(!admin_clave.value.match(/^[a-zA-Z0-9@#$%&.-]/)){
        message_admin_clave = 'La CONTRASEÑA no coincide con el formato solicitado'
        enviar = false;
    }else if (admin_clave.value.length < 7 || admin_clave.value.length > 20) {
        message_admin_clave = 'La CONTRASEÑA debe ser mayor a 7 digitos'
        enviar = false; 
    }

    getIDInput("usuario_nombre_error").innerHTML = message_nombre;
    getIDInput("usuario_apellidoP_error").innerHTML = message_apellidoP;  
    getIDInput("usuario_apellidoM_error").innerHTML = message_apellidoM;
    getIDInput("usuario_direccion_error").innerHTML = message_direccion;  
    getIDInput("usuario_tipo_error").innerHTML = message_tipo;
    getIDInput("usuario_email_error").innerHTML = message_email;
    getIDInput("usuario_privilegio_error").innerHTML = message_privilegio;    
    getIDInput("usuario_telefono_error").innerHTML = message_telefono;
    getIDInput("usuario_clave_1_error").innerHTML = message_clave1;  
    getIDInput("usuario_clave_2_error").innerHTML = message_clave2;
    getIDInput("email_admin_error").innerHTML = message_admin_email;  
    getIDInput("clave_admin_error").innerHTML = message_admin_clave;

    return enviar;
}

/* VALIDATION INPUTS COMPANY FORM */

function company_new_validata() {
    let codigo = getIDInput('educativo_codigo');
    let nombre = getIDInput('educativo_nombre');
    let dependencia = getIDInput('educativo_dependecia');
    let descripcion = getIDInput('educativo_descripcion');
    let dpto = getIDInput('educativo_dpto');
    let localidad = getIDInput('educativo_localidad');
    let direccion = getIDInput('educativo_direccion');
    let distrito = getIDInput('educativo_distrito');

    let message_codigo= ''
    let message_nombre = ''
    let message_dependencia = ''
    let message_descripcion = ''
    let message_dpto = ''
    let message_localidad = ''
    let message_direccion = ''
    let message_distrito = ''

    let enviar = true;

    if(codigo.value === null || codigo.value === ''){
        message_codigo = 'Este campo es requerido'
        enviar = false;
    }else if(!codigo.value.match(/^[a-zA-z0-9áéíóúÁÉÍÓÚñÑ. ]/)){
        message_codigo = 'El CODIGO RUE no coincide con el formato solicitado'
        enviar = false;
    }else if (codigo.value.length < 3 || codigo.value.length > 20) {
        message_codigo = 'El CODIGO RUE debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(nombre.value === null || nombre.value === ''){
        message_nombre = 'Este campo es requerido'
        enviar = false;
    }else if(!nombre.value.match(/^[a-zA-z0-9áéíóúÁÉÍÓÚñÑ. ]/)){
        message_nombre = 'El NOMBRE no coincide con el formato solicitado'
        enviar = false;
    }else if (nombre.value.length < 3 || nombre.value.length > 150) {
        message_nombre = 'El NOMBRE debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(dependencia.value === null || dependencia.value === ''){
        message_dependencia = 'Este campo es requerido'
        enviar = false;
    }

    if(descripcion.value !== '' && !descripcion.value.match(/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]/)){
        message_descripcion = 'La DESCRIPCION no coincide con el formato solicitado'
        enviar = false;
    }else if (descripcion.value !== '' && descripcion.value.length < 2 || descripcion.value.length > 255) {
        message_descripcion = 'La DESCRIPCION debe ser mayor a 2 caracteres'
        enviar = false; 
    }

    if(dpto.value === null || dpto.value === ''){
        message_dpto = 'Este campo es requerido'
        enviar = false;
    }

    if(localidad.value !== '' && !localidad.value.match(/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]/)){
        message_localidad = 'La LOCALIDAD no coincide con el formato solicitado'
        enviar = false;
    }else if (localidad.value !== '' && localidad.value.length < 3 || localidad.value.length > 150) {
        message_localidad = 'La LOCALIDAD debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(direccion.value !== '' && !direccion.value.match(/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]/)){
        message_direccion = 'La DIRECCION no coincide con el formato solicitado'
        enviar = false;
    }else if (direccion.value !== '' && direccion.value.length < 3 || direccion.value.length > 255) {
        message_direccion = 'La DIRECCION debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(distrito.value !== '' && !distrito.value.match(/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]/)){
        message_distrito = 'La DISTRITO no coincide con el formato solicitado'
        enviar = false;
    }else if (distrito.value !== '' && distrito.value.length < 3 || distrito.value.length > 255) {
        message_distrito = 'La DISTRITO debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    getIDInput("educativo_codigo_error").innerHTML = message_codigo;
    getIDInput("educativo_nombre_error").innerHTML = message_nombre;  
    getIDInput("educativo_dependecia_error").innerHTML = message_dependencia;
    getIDInput("educativo_descripcion_error").innerHTML = message_descripcion;  
    getIDInput("educativo_dpto_error").innerHTML = message_dpto;
    getIDInput("educativo_localidad_error").innerHTML = message_localidad;
    getIDInput("educativo_direccion_error").innerHTML = message_direccion;    
    getIDInput("educativo_distrito_error").innerHTML = message_distrito;
   
    return enviar;
}

function validateEmail(mail){
    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    if (emailRegex.test(mail))
      return true
    else 
      return false
}

function getIDInput(input) {
    return document.getElementById(input);
}

function deleteErrorMessage(input) {
    getIDInput(input).innerHTML = '';
}

function isNumberQ(number){
    if(isFinite(number))
        return true
    else
        return false
}

function teacher_update_2_validata() {
    let ci = getIDInput('docente_ci');
    let nombre = getIDInput('docente_nombre');
    let apellidoP = getIDInput('docente_apellidoP');
    let apellidoM = getIDInput('docente_apellidoM');
    let fechaNac = getIDInput('docente_fecha_nac');
    let telefono = getIDInput('docente_telefono');
    let direccion = getIDInput('docente_direccion');
    let email = getIDInput('docente_email');
    let clave1 = getIDInput('docente_clave_nueva_1');
    let clave2 = getIDInput('docente_clave_nueva_2');

    let message_ci = ''
    let message_nombre = ''
    let message_apellidoP = ''
    let message_apellidoM = ''
    let message_fechaNac = ''
    let message_telefono = ''
    let message_direccion = ''
    let message_email = ''
    let message_clave1 = ''
    let message_clave2 = ''

    let enviar = true;

    if(ci.value === null || ci.value === ''){
        message_ci = 'Este campo es requerido'
        enviar = false;
    }else if(!ci.value.match(/^[0-9-]/)){
        message_ci = 'El CI no coincide con el formato solicitado'
        enviar = false;
    }else if (ci.value.length < 5 || ci.value.length > 15) {
        message_ci = 'El CI debe ser mayor a 5 digitos'
        enviar = false; 
    }

    if(nombre.value === null || nombre.value === ''){
        message_nombre = 'Este campo es requerido'
        enviar = false;
    }else if(!nombre.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_nombre = 'El NOMBRE no coincide con el formato solicitado'
        enviar = false;
    }else if (nombre.value.length < 3 || nombre.value.length > 30) {
        message_nombre = 'El NOMBRE debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(apellidoP.value === null || apellidoP.value === ''){
        message_apellidoP = 'Este campo es requerido'
        enviar = false;
    }else if(!apellidoP.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_apellidoP = 'El APELLIDO PATERNO no coincide con el formato solicitado'
        enviar = false;
    }else if (apellidoP.value.length < 3 || apellidoP.value.length > 50) {
        message_apellidoP = 'El APELLIDO PATERNO debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(apellidoM.value === null || apellidoM.value === ''){
        message_apellidoM = 'Este campo es requerido'
        enviar = false;
    }else if(!apellidoM.value.match(/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]/)){
        message_apellidoM = 'El APELLIDO MATERNO no coincide con el formato solicitado'
        enviar = false;
    }else if (apellidoM.value.length < 3 || apellidoM.value.length > 50) {
        message_apellidoM = 'El APELLIDO MATERNO debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(fechaNac.value === null || fechaNac.value === ''){
        message_fechaNac = 'Este campo es requerido'
        enviar = false;
    }

    if(telefono.value === null || telefono.value === ''){
        message_telefono = 'Este campo es requerido'
        enviar = false;
    }else if(!telefono.value.match(/^[0-9()+]/)){
        message_telefono = 'El TELEFONO no coincide con el formato solicitado'
        enviar = false;
    }else if (telefono.value.length < 7 || telefono.value.length > 15) {
        message_telefono = 'El TELEFONO debe ser mayor a 7 digitos'
        enviar = false; 
    }

    if(direccion.value !== '' && !direccion.value.match(/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]/)){
        message_direccion = 'La DIRECCION no coincide con el formato solicitado'
        enviar = false;
    }else if (direccion.value !== '' &&  direccion.value.length < 3 || direccion.value.length > 150) {
        message_direccion = 'La DIRECCION debe ser mayor a 3 caracteres'
        enviar = false; 
    }

    if(email.value === null || email.value === ''){
        message_email = 'Este campo es requerido'
        enviar = false;
    }else if(!validateEmail(email.value)){
        message_email = 'Ha ingresado un CORREO no valido'
        enviar = false;
    } 

    if(clave1.value !== '' && !clave1.value.match(/^[a-zA-Z0-9@#$%&.-]/)){
        message_clave1 = 'La CONTRASEÑA no coincide con el formato solicitado'
        enviar = false;
    }else if (clave1.value !== '' && clave1.value.length < 7 || clave1.value.length > 20) {
        message_clave1 = 'La CONTRASEÑA debe ser mayor a 7 digitos'
        enviar = false; 
    }

    if(clave2.value !== '' &&  !clave2.value.match(/^[a-zA-Z0-9@#$%&.-]/)){
        message_clave2 = 'El CONTRASEÑA no coincide con el formato solicitado'
        enviar = false;
    }else if (clave2.value !== '' &&  clave2.value.length < 7 || clave2.value.length > 20) {
        message_clave2 = 'El CONTRASEÑA debe ser mayor a 7 digitos'
        enviar = false; 
    }

    if(clave1.value !== '' && clave2.value !== '' && clave1.value !== clave2.value){
        message_clave2 = 'La CONTRASEÑA que acaba de ingresar no coinciden'
    }

    getIDInput("docente_ci_error").innerHTML = message_ci;  
    getIDInput("docente_nombre_error").innerHTML = message_nombre;
    getIDInput("docente_apellidoP_error").innerHTML = message_apellidoP;  
    getIDInput("docente_apellidoM_error").innerHTML = message_apellidoM;
    getIDInput("docente_fecha_nac_error").innerHTML = message_fechaNac;  
    getIDInput("docente_telefono_error").innerHTML = message_telefono;
    getIDInput("docente_direccion_error").innerHTML = message_direccion;
    getIDInput("docente_email_error").innerHTML = message_email;    
    getIDInput("docente_clave_nueva_1_error").innerHTML = message_clave1;  
    getIDInput("docente_clave_nueva_2_error").innerHTML = message_clave2;

    return enviar;
}