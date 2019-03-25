<?php

		// Incluimos el archivo de configuración
		include '../config.php'; //Se usa para importar variables (copia del código)
		// Requerimos la clase de usuarios
		require '../lib/asesores.php'; //Se utliza para cuando se usan clases (va y busca lo que necesita el script)	
		
		$asesores = new asesores($datosConexionBD); //Instanciamos nuestra clase usuarios
		
		//$usuarios->nombre = $_POST['nombre'];
		$asesores->numeroEmpleado =$_POST['numeroEmpleado'];
		$asesores->apellidoPaterno =strtoupper($_POST['apellidoPaterno']);
		$asesores->apellidoMaterno =strtoupper($_POST['apellidoMaterno']);
		$asesores->nombre =strtoupper($_POST['nombre']);
		$asesores->correo =$_POST['correo'];
		$asesores->celular =$_POST['celular'];
		$asesores->correoAlternativo =$_POST['correoAlternativo'];
		$asesores->sexo =$_POST['sexo'];
		$asesores->unidadAcademica =$_POST['unidadAcademica'];
		$asesores->contrasenia =$_POST['contrasenia'];
		echo $asesores->altaAsesor(); //Manda a llamar el método guardarUsuario() para mostrar el valor que retorna.
?>