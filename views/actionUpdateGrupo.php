<?php
		include '../config.php'; //Se usa para importar variables (copia del 
		require '../lib/alumnos.php'; //Se utliza para cuando se usan clases (va y busca lo que necesita el script)	
		$alumnos = new alumnos($datosConexionBD);
		$alumnos->matricula =$_POST['matricula'];
		$alumnos->grupo =$_POST['grupo'];
		echo $alumnos->actualizarGrupo(); //Manda a llamar el método guardarUsuario() para mostrar el valor que retorna.
?>