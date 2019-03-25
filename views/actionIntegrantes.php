<?php
	session_start(); // Iniciar una nueva sesión o reanudar la existente
    include '../config.php';
    require '../lib/alumnos.php';
    $alumnos = new alumnos($datosConexionBD);
    $alumnos->id =$_REQUEST['idEquipo'];
    echo $alumnos->registrarIntegrantes();

?>