<?php

		// Incluimos el archivo de configuración

		include '../config.php'; //Se usa para importar variables (copia del código)

		// Requerimos la clase de usuarios

		require '../lib/equipos.php'; //Se utliza para cuando se usan clases (va y busca lo que necesita el script)	

		$equipos = new equipos($datosConexionBD);
		$equipos->id =$_POST['id'];
		$equipos->asesor =$_POST['asesor'];
		$equipos->nombre =strtoupper($_POST['nombre']);
		$equipos->nombrePS =strtoupper($_POST['nombrePS']);
		$equipos->descripcion =strtoupper($_POST['descripcion']);
		$equipos->clase =strtoupper($_POST['clase']);
		$equipos->periodo =$_POST['periodo'];
		$equipos->carrera =$_POST['carrera'];

		echo $equipos->actualizarEquipo(); //Manda a llamar el método guardarUsuario() para mostrar el valor que retorna.

?>