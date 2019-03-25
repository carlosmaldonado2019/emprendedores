<?php

		include '../config.php'; //Se usa para importar variables (copia del código)
		require '../lib/alumnos.php'; 
		require '../lib/equipos.php';

		$alumnos = new alumnos($datosConexionBD);
		$equipos = new equipos($datosConexionBD);
		
		$alumnos->matricula =$_POST['matricula'];
		$alumnos->apellidoPaterno =strtoupper($_POST['apellidoPaterno']);
		$alumnos->apellidoMaterno =strtoupper($_POST['apellidoMaterno']);
		$alumnos->nombre =strtoupper($_POST['nombre']);
		$alumnos->correo =$_POST['correo'];
		$alumnos->celular =$_POST['celular'];
		$alumnos->carrera =$_POST['carrera'];
		$alumnos->sexo =$_POST['sexo'];
		$alumnos->edad =$_POST['edad'];
		$alumnos->empresa =$_POST['empresa'];
		$alumnos->unidadAcademica =$_POST['unidadAcademica'];
		$alumnos->contrasenia =$_POST['contrasenia'];
		$alumnos->semestre =$_POST['semestre'];
		$alumnos->correoAlternativo =$_POST['correoAlternativo'];
		$alumnos->fecha =$_POST['fecha'];
		$alumnos->grupo =$_POST['grupo'];
		$alumnos->periodo =$_POST['periodo'];
                


		$equipos->carrera =$_POST['carrera'];
		$equipos->empresa =$_POST['empresa'];

		echo $equipos->cambioTipoEquipo();
		echo $alumnos->altaAlumno(); 

?>