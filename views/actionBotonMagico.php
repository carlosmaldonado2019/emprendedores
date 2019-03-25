<?php
	session_start(); // Iniciar una nueva sesión o reanudar la existente
    include '../config.php';
    require '../lib/equipos.php';
    $equipos = new equipos($datosConexionBD);
    $equipos->empresa =$_POST['empresa'];  
    $equipos->carrera =$_POST['carrera'];   
    echo $equipos->cambioTipoEquipo();
?>