<?php
    if($peticionAjax){
        require_once "../../config/SERVER.php";
        include_once "../../vendor/autoload.php";
    }else{
        require_once "./config/SERVER.php";
    }

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    class main_model{
        /* funcion para conetar a la BD*/
        protected static function conectar(){
            $conexion = new PDO(SGBD, user, pass);
            $conexion->exec("SET CHARACTER SET utf8");
            return $conexion;
        }

        /* funcion para ejecutar consultas simples */
        protected static function ejecutar_consulta_simple($consulta){
            $sql=self::conectar()->prepare($consulta);
            $sql->execute();
            return $sql;
        }

        /* encriptar cadenas */
        public static function encryption($string){
			$output=FALSE;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
			$output=base64_encode($output);
			return $output;
		}

        /* desencriptar cadenas */
		protected static function decryption($string){
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
			return $output;
		}

        /* funcion para generar codgos aleatorios */
        protected static function generar_codigo_aleatorio($letra,$longitud,$numero){
            for($i=1; $i<=$longitud; $i++){
                $aleatorio= rand(0,9);
                $letra.=$aleatorio;
            }
            return $letra."-".$numero;
        }

         /* funcion para limpiar cadenas */
         protected static function limpiar_cadena($cadena){
            $cadena=trim($cadena);
            $cadena=stripslashes($cadena);
            $cadena=str_ireplace("<script>", "", $cadena);
            $cadena=str_ireplace("</script>", "", $cadena);
            $cadena=str_ireplace("<script src", "", $cadena);
            $cadena=str_ireplace("<script type=", "", $cadena);
            $cadena=str_ireplace("SELECT * FROM", "", $cadena);
            $cadena=str_ireplace("DELETE FROM", "", $cadena);
            $cadena=str_ireplace("INSERT INTO", "", $cadena);
            $cadena=str_ireplace("DROP TABLE", "", $cadena);
            $cadena=str_ireplace("DROP DATABASE", "", $cadena);
            $cadena=str_ireplace("TRUNCATE TABLE", "", $cadena);
            $cadena=str_ireplace("SHOW TABLES", "", $cadena);
            $cadena=str_ireplace("SHOW DATABASES", "", $cadena);
            $cadena=str_ireplace("<?php", "", $cadena);
            $cadena=str_ireplace("?>", "", $cadena);
            $cadena=str_ireplace("--", "", $cadena);
            $cadena=str_ireplace(">", "", $cadena);
            $cadena=str_ireplace("<", "", $cadena);
            $cadena=str_ireplace("[", "", $cadena);
            $cadena=str_ireplace("]", "", $cadena);
            $cadena=str_ireplace("^", "", $cadena);
            $cadena=str_ireplace("==", "", $cadena);
            $cadena=str_ireplace(";", "", $cadena);
            $cadena=str_ireplace("::", "", $cadena);
            $cadena=stripslashes($cadena);
            $cadena=trim($cadena);
            return $cadena;
         }

         /* funcion verificar campos del formulario */
         protected static function verificar_datos($filtro,$cadena){
            if(preg_match("/^".$filtro."$/", $cadena)){
                return false;
            }else{
                return true;
            }
         }

         /* funcion verificar fecha */
         protected static function verificar_fecha($fecha){
            $valores=explode('-', $fecha);
            if(count($valores)==3 && checkdate($valores[1],$valores[2],$valores[0])){
                return false;
            }else{
                return true;
            }
         }

         /* funcion paginador de tablas */
         protected static function paginador_tablas($pagina, $Npaginas, $url, $botones){
            $tabla='  <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">';

            if($pagina==1){
                $tabla.='<li class="page-item disabled">
                <a class="page-link"><i class="fas fa-angle-double-right"></i></a></li>';
            }else{
                $tabla.='
                <li class="page-item"><a class="page-link" href="'.$url.'1/"><i class="fas fa-angle-double-left"></i></a></li>
                <li class="page-item"><a class="page-link" href="'.$url.($pagina-1).'/">Anterior</a></li>
                ';
            }

            $ci=0;
            for($i=$pagina; $i<=$Npaginas; $i++){
                if($ci>=$botones){
                    break;
                }

                if($pagina==$i){
                    $tabla.='<li class="page-item"><a class="page-link active" href="'.$url.$i.'/">'.$i.'</a></li>';
                }else{
                    $tabla.='<li class="page-item"><a class="page-link" href="'.$url.$i.'/">'.$i.'</a></li>';
                }
                $ci++;
            }

            if($pagina==$Npaginas){
                $tabla.='<li class="page-item disabled">
                <a class="page-link"><i class="fas fa-angle-double-left"></i></a></li>';
            }else{
                $tabla.='
                <li class="page-item"><a class="page-link" href="'.$url.($pagina+1).'/">Siguiente</a></li>
                <li class="page-item"><a class="page-link" href="'.$url.$Npaginas.'/"><i class="fas fa-angle-double-right"></i></a></li>
                ';
            }

            $tabla.='</ul></nav>';

            return $tabla;
         }

         /* encriptar cadenas */
        public function codigo_aleatorio(){
            $fecha = date("Y");   
            $random = rand(100000, 999999);
            $acortar = substr($random, 0, 6); 
            $codigo = $fecha.$acortar;
			return $codigo;
		}

        /* generar token */
        public function token_jwt($id_user,$rol){
            $key = 'academico_voip_umss';
            $time = time();
            $token = [
                'id' => $id_user,
                "iat" => $time,
                "exp" => $time + (60*60),
                "rol" => $rol,
            ];

            $jwt = JWT::encode($token, $key, 'HS256');
            
            return  $jwt;
        }

        /* validar token */
        public function validate_token_jwt($token){
            $key = 'academico_voip_umss';
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            return json_encode($decoded);
        }

        /* enviar mail */
        public function  send_mail($datos,$mails){
            include_once "../../vendor/autoload.php";
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;  
                $mail->Username   = 'academico.voip@gmail.com';
                $mail->Password   = 'egkrojiccdxeixbl'; 
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465;     
            
                $mail->setFrom('academico.voip@gmail.com', 'Sistema academico VOIP');
                foreach($mails as $destino) {
                    $mail->addAddress($destino['CORREO_A']);
                }

                $mail->isHTML(true);
                if($datos['event'] == 'update') $mail->Subject = 'Conferencia Reprogramada - '.$datos['title'];
                else $mail->Subject = $datos['title'];
                $mail->Body    = '<div class="container">
                <p><h4><b>Descripci??n</b></h4></p>'
                .'<p>'.$datos['description'].'</p>'
                .'<p><h4><b>Informaci??n de la conferencia</b></h4></p>'
                .'<p><b>Fecha de inicio: </b>'.$datos['start'].'</p>'
                .'<p><b>Fecha fin: </b>'.$datos['end'].'</p>'
                .'<p><b>N??mero de sala: </b>'.$datos['sala'].'</p>'
                .'<p><h4><b>Informaci??n adicional</b></h4></p>'
                .'<p><b>Unidad Acad??mica: </b>'.$datos['ua'].'</p>'
                .'<p><b>Docente: </b>'.$datos['docente'].'</p>'
                .'<p><b>Turno: </b>'.$datos['turno'].'</p>'
                .'<p><b>Grado: </b>'.$datos['grado'].'</p>'
                .'<p><b>Secci??n: </b>'.$datos['seccion'].'</p>';
            
                $mail->send();
                return true;
            } catch (Exception $e) {
                return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

    }