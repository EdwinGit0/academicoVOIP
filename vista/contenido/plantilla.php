<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title><?php echo COMPANY?></title>
	
    <?php include "./vista/inc/Link.php"; ?>
</head>
<body>
	<?php
		$peticionAjax=false;
		require_once "./controlador/vista/controlador_vista.php";
		$IV = new controlador_vista();

		$vistas = $IV->obtener_vista_controlador();

		if($vistas=="login" || $vistas=="404"){
			require_once "./vista/contenido/login/".$vistas."-view.php";
		}else{
			session_start(['name'=>'SA']);

			$pagina=explode("/", $_GET['views']);
			require_once "./controlador/admin/controlador_login.php";
			$cl= new controlador_login();

			if($pagina[0]=="admin"){
				if(!isset($_SESSION['token_sa']) || !isset($_SESSION['nombre_sa'])
				|| !isset($_SESSION['privilegio_sa']) || !isset($_SESSION['id_sa']) || $_SESSION['usuario']!="admin"){
					echo $cl->forzar_cierre_sesion_controlador();
					exit();
				}

			}elseif($pagina[0]=="docente"){
				if(!isset($_SESSION['token_sa']) || !isset($_SESSION['nombre_sa'])
				|| !isset($_SESSION['id_sa']) || $_SESSION['usuario']!="docente"){
					echo $cl->forzar_cierre_sesion_controlador();
					exit();
				}
			}

	?>
		<!-- Main container -->
		<main class="full-box main-container">
			<!-- Nav lateral -->
			<?php include "./vista/contenido/".$pagina[0]."/inc/NavLateral.php"; ?>
			<!-- Page content -->
			<section class="full-box page-content">
				<?php 
					include "./vista/inc/NavBar.php"; 
					
					include $vistas; 
				?>
			</section>
		</main>
		<?php 
			include "./vista/contenido/login/inc/logOut.php"; 
		}
		include "./vista/inc/Script.php"; 
	?>
</body>
</html>