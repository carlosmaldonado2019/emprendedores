<?php
session_start();
include 'config.php'; // Incluimos el archivo de configuración
require 'lib/alumnos.php'; // Requerimos la clase de usuarios	
$alumnos = new alumnos($datosConexionBD);
$alumnos->matricula = $_REQUEST['folio'];
echo $alumnos->updateConstancia();
?>