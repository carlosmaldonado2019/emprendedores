<?php

		// Incluimos el archivo de configuración
		include '../config.php'; //Se usa para importar variables (copia del código)
		// Requerimos la clase de usuarios
		require '../lib/grupos.php'; //Se utliza para cuando se usan clases (va y busca lo que necesita el script)	
		
		$grupos = new grupos($datosConexionBD);
		$grupos->id =$_POST['id'];
		echo $grupos->eliminarGrupo(); //Manda a llamar el método guardarUsuario() para mostrar el valor que retorna.
?>