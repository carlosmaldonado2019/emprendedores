<?php
		include '../config.php'; 
		require '../lib/asesores.php';
		$asesores = new asesores($datosConexionBD);
		$asesores->id =$_POST['id'];
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
		echo $asesores->editarAsesor(); 
?>