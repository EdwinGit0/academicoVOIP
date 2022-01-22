<script>
    let btn_salir=document.querySelector(".btn-exit-system");
    btn_salir.addEventListener('click', function(e){
        e.preventDefault();
        Swal.fire({
			title: '¿Quieres salir del sistema?',
			text: "La sesion actual se cerrara y saldras del sistema",
			type: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, salir',
			cancelButtonText: 'No, cancelar'
		}).then((result) => {
			if (result.value) {
				let url='<?php echo SERVERURL; ?>ajax/loginAjax.php';
                let token='<?php echo $cl->encryption($_SESSION['token_sa']);?>';
                let email='<?php echo $cl->encryption($_SESSION['correo_sa']);?>';

                let datos = new FormData();
                datos.append("token",token);
                datos.append("email",email);

                fetch(url,{
                    method: 'POST',
                    body: datos
                })
                .then(respuesta => respuesta.json())
                .then(respuesta => {
                    return alertas_ajax(respuesta);
                });
			}
		});
    });
</script>