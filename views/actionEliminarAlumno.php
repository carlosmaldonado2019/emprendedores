<?php

		// Incluimos el archivo de configuración
		include '../config.php'; //Se usa para importar variables (copia del código)
		// Requerimos la clase de usuarios
		require '../lib/alumnos.php'; //Se utliza para cuando se usan clases (va y busca lo que necesita el script)	
		
		$alumnos = new alumnos($datosConexionBD);
		$alumnos->id =$_POST['id'];
		echo $alumnos->eliminarAlumno(); //Manda a llamar el método guardarUsuario() para mostrar el valor que retorna.
?>