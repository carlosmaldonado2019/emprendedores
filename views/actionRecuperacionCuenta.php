<?php

session_start();

	if(isset($_POST['correo'])){	
		include '../config.php';
		require '../lib/usuarios.php';

		$usuarios = new usuarios($datosConexionBD);
		$usuarios->correo = $_POST['correo'];
		$usuarios->celular = $_POST['celular']; 
		echo $usuarios->recuperacionCuenta(); 
	}

?>