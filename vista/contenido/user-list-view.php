<?php 
	if($_SESSION['privilegio_sa']!=1){
		echo $cl->forzar_cierre_sesion_controlador();
		exit();
	}
?>
<div class="full-box page-header">
	<h3 class="text-left">
		<i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE ADMINISTRADORES
	</h3>
	<p class="text-justify">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit nostrum rerum animi natus beatae ex. Culpa blanditiis tempore amet alias placeat, obcaecati quaerat ullam, sunt est, odio aut veniam ratione.
	</p>
</div>

<div class="container-fluid">
	<ul class="full-box list-unstyled page-nav-tabs">
		<li>
			<a href="<?php echo SERVERURL; ?>user-new/"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO ADMINISTRADOR</a>
		</li>
		<li>
			<a class="active" href="<?php echo SERVERURL; ?>user-list/"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE ADMINISTRADOR</a>
		</li>
		<li>
			<a href="<?php echo SERVERURL; ?>user-search/"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR ADMINISTRADOR</a>
		</li>
	</ul>	
</div>

<div class="container-fluid">
	<?php
		require_once "./controlador/controlador_usuario.php";
		$ins_admin = new controlador_usuario();

		echo $ins_admin->paginador_admin_controlador($pagina[1],15,$_SESSION['privilegio_sa'],$_SESSION['id_sa'],$pagina[0],"");
	?>
</div>