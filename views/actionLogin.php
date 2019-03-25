<?php

session_start();

	if(isset($_POST['correo'])){	
		include '../config.php';
		require '../lib/usuarios.php';

		$usuarios = new usuarios($datosConexionBD);
		$usuarios->correo = $_POST['correo'];
		$usuarios->contrasenia = $_POST['contrasenia']; 
		echo $usuarios->loginUsuario(); 
	}

?>