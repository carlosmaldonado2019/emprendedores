<?php

		// Incluimos el archivo de configuración
		include '../config.php'; //Se usa para importar variables (copia del código)
		// Requerimos la clase de usuarios
		require '../lib/unidades.php'; //Se utliza para cuando se usan clases (va y busca lo que necesita el script)	
		
		$unidades = new unidades($datosConexionBD);

		$unidades->id =$_POST['id'];
		$unidades->clave =$_POST['clave'];
		$unidades->nombre =$_POST['nombre'];
		
		echo $unidades->editarUnidad(); //Manda a llamar el método guardarUsuario() para mostrar el valor que retorna.
?>