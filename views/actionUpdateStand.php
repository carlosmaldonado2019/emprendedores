<?php
		include '../config.php'; //Se usa para importar variables (copia del 
		require '../lib/equipos.php'; //Se utliza para cuando se usan clases (va y busca lo que necesita el script)	
		$equipos = new equipos($datosConexionBD);
		$equipos->id =$_POST['id'];
		$equipos->stand =$_POST['stand'];
		echo $equipos->actualizarStand(); //Manda a llamar el método guardarUsuario() para mostrar el valor que retorna.
?>